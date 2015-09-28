#!/usr/bin/env perl
use warnings;
use strict;
use Carp;
use POSIX ":sys_wait_h"; ##zombie process

use File::Basename;

#define global variables
our $CARETAKER = "kaichop\@gmail.com";

our $SERVER_DIRECTORY = "/var/www/html/loh/";
our $HTML_DIRECTORY = "${SERVER_DIRECTORY}/html";
our $WORK_DIRECTORY = "$SERVER_DIRECTORY/work";
our $LIB_DIRECTORY = "$SERVER_DIRECTORY/lib";
our $BIN_DIRECTORY = "$SERVER_DIRECTORY/bin";
our $SUBMISSION_ID_FILENAME = "$WORK_DIRECTORY/submission_id";
our $PID_LOCK_FILENAME = "$WORK_DIRECTORY/pid.lock";
our $zombies = 0;

#prepare PATH environmental variable
$ENV{PATH} = "$BIN_DIRECTORY:$ENV{PATH}";

#BEGINNING THE CHECKING OF LOG, ERROR AND SUBMISSION_ID FILES, RETRIEVE THE PREVIOUS FAILURE IF THERE IS ANY, SET THE CORRECT OLD_ID VALUE
my ($old_submission_id, $submission_id, $keep_temp);

#setting up a signal handler for Ctrl+C, which can be used to stop this program from running
$SIG{INT} = \&deletePidFile;
#statistic number of zombie process
$SIG{CHLD} = sub { $zombies++ };  


if (defined $ARGV[0]) {
	$keep_temp = $ARGV[1]||0;
	open (STDERR, ">$WORK_DIRECTORY/loh_error_log") or confess "Error: unable to redirect STDERR to error log file $WORK_DIRECTORY/loh_error_log";

	if ($ARGV[0] =~ m/^(\d+)$/) {
		chdir ("$WORK_DIRECTORY/$1") or confess "Error: cannot change to the desired directory $WORK_DIRECTORY/$1: $!";
		print STDERR "\n\n\n\n\nNOTICE: time=", scalar (localtime), " command=$0\n";
		processSubmission ($ARGV[0]);
	} elsif ($ARGV[0] =~ m/^(\d+)\-(\d+)$/) {
		for ($1 .. $2) {
			chdir ("$WORK_DIRECTORY/$_") or confess "Error: cannot change to the desired directory $WORK_DIRECTORY/$_: $!";
			print STDERR "\n\n\n\n\nNOTICE: time=", scalar (localtime), " command=$0\n";
			processSubmission ($_);
		}
	} elsif ($ARGV[0] eq '-h') {
		die "Usage: $0 <submission-id> [keep-temp]\nFunction: process webannovar submission. When no argument is given this program will run continuously until pressing Ctrl+C\n\n" .
			"Example: control_annovar.pl.pl 12\n\tProcess submission id 12\nExample: control_annovar.pl.pl 10-20\n\tProcess submission id 10, 11, .. 20\n";
	} else {
		confess "Error: <submission-id> must be a positive integer or a range of positive integers!\n\nUsage: $0 <submission-id> [keep-temp]\nFunction: process webannovar submissions\n";
	}
} else {

	#now we want to record the STDERR so that we know what the error messages are
	open (STDERR, " | tee -a loh_error_log 1>&2") or confess "Error: unable to redirect STDERR to error log file";
	print STDERR "\n\n\n\n\nNOTICE: time=", scalar (localtime), " command=$0\n";

	checkAndWritePidFile ();
	$old_submission_id = readSubmissionID ();
	my $last_processed_submission_id = checkUnprocessedSubmission ();
	if ($last_processed_submission_id <= $old_submission_id) {
		print STDERR "*"x80, "\nWARNING: submissions from $last_processed_submission_id to $old_submission_id have NOT been processed!\n";
		print STDERR "Pressing Ctrl+C then running 'control_annovar.pl.pl $last_processed_submission_id-$old_submission_id' will solve this probem!\n", "*"x80, "\n";
	}
	print STDERR "old_submission_id = $old_submission_id ...\n";
	while (1) {
		$submission_id = readSubmissionID ();
		if ($submission_id > $old_submission_id) {
			for (($old_submission_id+1) .. $submission_id) {
				while (`ps aux | fgrep control_annovar.pl | wc -l` > 6) {
					print "Exceed the maximum number of processing submissions";
					sleep 30;
				}
				defined(my $pid1=fork()) or die "Fork process failed:$!\n";
				if ($pid1) {
					&REAPER if $zombies;
				} else {
					print STDERR "processing submission $_ ...\n";
					processSubmission ($_);  
					exit;   
				}
			}
		}
		$old_submission_id = $submission_id;
		print STDERR "wait 100 seconds before checking again ...\n";
		select (undef, undef, undef, 100);
	}
}

#this subroutine is used to delete the temporary PID file, so that we know the program exits successfully.
#if a PID file exists but the program is not running, then we know there must be something wrong and the program exits unexpectedly.
sub deletePidFile {
	-f $PID_LOCK_FILENAME or confess "Error: cannot find pid file $PID_LOCK_FILENAME";
	unlink ($PID_LOCK_FILENAME) or confess "Error: cannot delete pid file $PID_LOCK_FILENAME: $!";
	print STDERR "Successfully deleted pid file $PID_LOCK_FILENAME\nProgram exited!\n";
	exit (0);
}

#this subroutine check the existence of PID file, and generate a new one if it does not exist.
#if a PID file already exists, then it is possible that (1) another instance of the program is running (2) the previous program exits unexpectedly
sub checkAndWritePidFile {
	-f $PID_LOCK_FILENAME and confess "Error: another process may be running. check the $PID_LOCK_FILENAME file for details";
	open (PID, ">$PID_LOCK_FILENAME") or confess "Error: cannot write to pid file $PID_LOCK_FILENAME: $!";
	print PID "time=", scalar (localtime), "\n";
	print PID "host=", `hostname`;
	print PID "pid=$$\n";
	close (PID);
}

sub readSubmissionID {
	open (SUBMISSION_ID, $SUBMISSION_ID_FILENAME) or confess "Error: cannot open submission_id file $SUBMISSION_ID_FILENAME: $!";
	flock SUBMISSION_ID, 1;
	my $submission_id = <SUBMISSION_ID>;
	flock SUBMISSION_ID, 8;
	close (SUBMISSION_ID);
	return $submission_id;
}

sub checkUnprocessedSubmission {
	my $submission_id = $old_submission_id;
	while ($submission_id) {
		-f "$WORK_DIRECTORY/done/$submission_id/email" and last;#######
		$submission_id--;
	}
	$submission_id++;
	return $submission_id;
}

sub processSubmission {
        my ($id) = @_;
        my %info;
	my ($system_command);
	my ($failed_command);
	my $result_page = '';

	#enter the working directory, so that all temporary files are confined in this directory
	chdir ("$WORK_DIRECTORY/$id") or confess "Error: cannot change to the desired directory $WORK_DIRECTORY/$id: $!";

	open (INFO, "info") or warn "Error: cannot read info file $WORK_DIRECTORY/$id/info: $!" and return;
	while (<INFO>) {
		chomp;
		my ($key, $value) = split ('=', $_);
		$info{$key} = $value;
	}
	close (INFO);

	-f "email" and -s "email" and print STDERR "WARNING: skipping submission $id since it has been already executed (the $WORK_DIRECTORY/$id/email file exists)\n" and return;

        my $process_time = scalar (localtime);
        my ($email_header, $email_body, $email_tail);
	my $password = $info{password};

	$system_command = "bed2gene.pl query.bed $LIB_DIRECTORY/humandb -outfile query.table -buildver $info{buildver} -omimfile $LIB_DIRECTORY/genemap";
	if ($info{genefile}) {
		my @genefile = split (/,/, $info{genefile});
		my @genefile1;
		for my $nextfile (@genefile) {
			if ($nextfile eq 'userphengene.txt' or $nextfile eq 'usergene.txt') {
				push @genefile1, $nextfile;
			} else {
				push @genefile1, "$LIB_DIRECTORY/$nextfile";
			}
		}
		my $genefile = join (',', @genefile1);
		$system_command .= " -genefile $genefile";
	}
	$system_command .= " 2> query.bed2gene.log";
	
	print STDERR "NOTICE: Running system command <$system_command>\n";
	system ($system_command) and die "cannot run system command <$system_command>\n";

	open (RES, "sort -k 1,1n query.table | ") or die "Error: cannot read result file query.table: $!\n";
	open (HTML, ">index.html") or die "can't write out index.html: $!";
	print HTML "<html>\n";
	print HTML "<h1>Summary</h1>\n";
	print HTML "<p>Dear LOH user, your submission (identifier: $id) was received at $info{submission_time} and processed at $process_time.</p>\n";
	
	print HTML "<p>", qx/fgrep disrupt query.bed2gene.log/, "</p>\n";
	print HTML "<p>", qx/fgrep identified query.bed2gene.log/, "</p>\n";
	print HTML "<h1>Submission information</h1>\n";
	print HTML "<ul><li>bedfile=$info{bedfile}</li>\n";
	print HTML "<li>genefile=$info{genefile}</li>\n";
	print HTML "<li>buildver=$info{buildver}</li></ul>\n";
	print HTML "<h1>Prioritized gene list</h1>\n";
	print HTML "<table border=5>\n";
	print HTML "<tr><th width=250>LOH Region</th><th>Gene</th><th>Cytoband</th><th>Gene Desc</th><th>Disorder</th></tr>\n";
	while (<RES>) {
		s#\t#</td><td>#g;
		s#^#<tr><td>#;
		s#$#</td></tr>\n#;
		print HTML $_;
	}
	print HTML "\n</table></html>\n";
	close (RES);
	close (HTML);
	
	$email_header = "Dear LOH user, your submission (identifier: $id) was received at $info{submission_time} and processed at $process_time.\n";
	$email_header =~ s/(.{1,69})\s/$1\n/g;

	if ($failed_command) {
		$email_body = "We were unable to generate results for your submission due to an '$failed_command' error.\n";
	} else {
		$email_body = "Your submission is done: http://loh.usc.edu/done/$id/$password/index.html\n\n";#### url
		$email_body .= "bedfile=$info{bedfile}\nbuildver=$info{buildver}\n\n";
		
		
		
		
	
		$email_tail .= "The citation for the above result is: http://loh.usc.edu\n\n";
		$email_tail .= "Questions or comments may be directed to $CARETAKER.\n";
		$email_tail =~ s/(.{1,69})\s/$1\n/g;
	}
		
	open (EMAIL, ">email") or warn ">" . scalar (localtime) . " (id: $id)\ncannot create new mail $ARGV[1]\n" and return;
	flock (EMAIL, 2);
	print EMAIL "From: $CARETAKER\nReply-To: $CARETAKER\nSubject: LOH web server results for your query (identifier: $id)\n\n";
	print EMAIL $email_header, '-'x70, "\n\n", $email_body, '-'x70, "\n\n", $email_tail, "\n";
	flock (EMAIL, 2);
	close (EMAIL);

	if ($info{email}) {
		system ("/usr/sbin/sendmail $info{email} < $WORK_DIRECTORY/$id/email") and warn '>' . scalar(localtime) . " (id: $id)\ncannot send mail\n" and return 0;
	}
	
	system("cp index.html $HTML_DIRECTORY/done/$id/$password") and warn "Error runnning <cp index.html $HTML_DIRECTORY/done/$id/$password>";
}


sub count {
	my ($file) = @_;
        my $count;
	if (-f $file) {
		$count = `cat $file | wc -l`;
		chomp $count;
		return $count;
	} else {
		return 0;
	}
}

sub REAPER {
	my $pid;
	while (($pid = waitpid(-1, WNOHANG)) > 0) {
		$zombies--;
	}
}
