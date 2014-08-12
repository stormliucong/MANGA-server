package GenomicsServer;
use warnings;
use strict;
use POSIX ":sys_wait_h";
use Exporter;
use File::Basename;


#Kai's notes:
#An alternative to SIG{CHLD}=IGNORE is to use the following snipets (http://www.schwer.us/journal/2008/02/06/perl-sigchld-ignore-system-and-you/)
#sub REAPER { 1 until waitpid(-1 , WNOHANG) == -1 };
#$SIG{CHLD} = \&REAPER;

our $VERSION     = 1.01;
our @ISA         = qw(Exporter);
our @EXPORT      = qw($SETUPVAR $CARETAKER $SERVER_DIRECTORY $HTML_DIRECTORY $CGI_DIRECTORY $BIN_DIRECTORY $LIB_DIRECTORY $WORK_DIRECTORY 
				$WEBSITE $SUBMISSION_ID_FILENAME $PROCESSED_ID_FILENAME $RANDOM_PASS $SUBMISSION_ID);	#@EXPORT contains a list of functions that we export by default
our @EXPORT_OK   = qw(&jobMonitor &verifyEmail &setupVariable &prepareWorkDirectory &generatePrelimResult &executeProgram &checkUnprocessedSubmission &countConcurrentProcess &generateRandomPassword);							#@EXPORT_OK contains a list of functions that we export on demand
our %EXPORT_TAGS = ( DEFAULT => [qw($SETUPVAR $CARETAKER $SERVER_DIRECTORY $HTML_DIRECTORY $CGI_DIRECTORY $BIN_DIRECTORY $LIB_DIRECTORY $WORK_DIRECTORY 
				$WEBSITE $SUBMISSION_ID_FILENAME $PROCESSED_ID_FILENAME $RANDOM_PASS $SUBMISSION_ID)],
                     COMPLETE=> [qw(&jobMonitor &verifyEmail &setupVariable &prepareWorkDirectory &generatePrelimResult &executeProgram &checkUnprocessedSubmission &countConcurrentProcess &generateRandomPassword)]);		#This hash stores labels pointing to array references

our ($WEBSITE, $SETUPVAR, $CARETAKER, $SERVER_DIRECTORY, $HTML_DIRECTORY, $CGI_DIRECTORY, $BIN_DIRECTORY, $LIB_DIRECTORY, $WORK_DIRECTORY, $SUBMISSION_ID_FILENAME,
	$PROCESSED_ID_FILENAME, $RANDOM_PASS, $SUBMISSION_ID);

#Hui Yang added this sub to check the email
sub verifyEmail{
    @_==2 or die "Error:please supply the EMAIL address and CGI reference";
    my ($email,$q)=@_;
	if ($email and $email !~ /^(\w|\-|\.)+\@((\w|\-)+\.)+[a-zA-Z]{2,}$/) {
	print $q->header(-status=>'invalid email address'),
		$q->start_html('ERROR'),
		$q->h2('Please enter a valid email address');
	exit (0);
}
}
#Hui Yang added this sub to return a hash of the current running and queued jobs
sub jobMonitor{
@_==1 or die "Please supply your marker file to monitor!";
my $marker_file=@_;
my (%jobstatus,@dirlist);
 opendir(DH,$WORK_DIRECTORY) or die "can't open $WORK_DIRECTORY: $!";
 @dirlist=sort readdir(DH);
 foreach my $id(@dirlist){
 	next unless $id=~/^\d+$/;
 	next unless -d "$WORK_DIRECTORY/$id";
 	if(-s "$WORK_DIRECTORY/$id/$marker_file")
 	{
 		$jobstatus{$id}="running";
 	}
 		else {
 			$jobstatus{$id}="queued";			
 		}
     
 }     return %jobstatus;  
}
sub setupVariable {                      #Hui Yang added the WEBSITE here
	@_ == 3 or die "Error: please supply CARETAKER and SERVER_DIRECTORY\n";
	($CARETAKER,$SERVER_DIRECTORY,$WEBSITE) = @_;
	$HTML_DIRECTORY = "${SERVER_DIRECTORY}/html";
	$CGI_DIRECTORY = "${SERVER_DIRECTORY}/cgi-bin";
	$BIN_DIRECTORY = "${SERVER_DIRECTORY}/bin";
	$LIB_DIRECTORY = "${SERVER_DIRECTORY}/lib";
	$WORK_DIRECTORY = "${SERVER_DIRECTORY}/work";
	$SUBMISSION_ID_FILENAME = "${WORK_DIRECTORY}/submission_id";
	$PROCESSED_ID_FILENAME = "${WORK_DIRECTORY}/processed_id";
	
	open (SUBMISSION_ID, $SUBMISSION_ID_FILENAME) or die "Error: cannot open submission_id file $SUBMISSION_ID_FILENAME in work directory $WORK_DIRECTORY: $!";
	flock SUBMISSION_ID, 1;
	$SUBMISSION_ID = <SUBMISSION_ID>;
	flock SUBMISSION_ID, 8;
	close (SUBMISSION_ID);
	
	$RANDOM_PASS = generateRandomPassword (16);
	$SETUPVAR = 1;
}
#Now the submission_id file could be generated automatically if not existing.
sub prepareWorkDirectory {
	$SETUPVAR or die "Error: package global variable not set up yet\n";
		
	-d $WORK_DIRECTORY or die "Error: work directory $WORK_DIRECTORY does not exist";
	-f $SUBMISSION_ID_FILENAME or (system ">$SUBMISSION_ID_FILENAME" and chmod 0777,$SUBMISSION_ID_FILENAME) or die "Error:$SUBMISSION_ID_FILENAME does not exist and can't be created!";
	-f $PROCESSED_ID_FILENAME or (system ">$PROCESSED_ID_FILENAME" and chmod 0777,$PROCESSED_ID_FILENAME) or die "Error:$PROCESSED_ID_FILENAME does not exist and can't be created!";
	
	open (SUBMISSION_ID, $SUBMISSION_ID_FILENAME) or die "Error: cannot open submission_id file $SUBMISSION_ID_FILENAME in work directory $WORK_DIRECTORY: $!";
	flock SUBMISSION_ID, 1;
	$SUBMISSION_ID = <SUBMISSION_ID>;
	flock SUBMISSION_ID, 8;
	close (SUBMISSION_ID);
	defined $SUBMISSION_ID or $SUBMISSION_ID=0; 
	$SUBMISSION_ID ++;
	open (SUBMISSION_ID, ">$SUBMISSION_ID_FILENAME") or die "Error: cannot write submission_id file in work directory $WORK_DIRECTORY: $!";
	flock SUBMISSION_ID, 2;
	print SUBMISSION_ID $SUBMISSION_ID;
	flock SUBMISSION_ID, 8;
	close (SUBMISSION_ID);
	
	mkdir ("$WORK_DIRECTORY/$SUBMISSION_ID") or die "Error: cannot generate submission directory for submission id $SUBMISSION_ID: $!";
	chmod 0777, "$WORK_DIRECTORY/$SUBMISSION_ID" or die "Error: unable to set the permission of directories: $!";
	
}
	
#This function reveives a number and outputs a random password with the length of this number
sub generateRandomPassword {
	@_==1 or die ("Only one variable is accepted!");
	my $maxLenth=$_[0];
	my @a = (0..9,'a'..'z','A'..'Z','-','_');
	my $password = join '', map { $a[int rand @a] } 0..($maxLenth-1);        
	return $password;
}

sub generatePrelimResult {
	my ($string) = @_;
	defined $string or die "Error: result string is required";
	
	if (-e "$HTML_DIRECTORY/done/$SUBMISSION_ID") {
		system ("rm -rf $HTML_DIRECTORY/done/$SUBMISSION_ID") and die "can not remove submission $SUBMISSION_ID folder";
	}
	mkdir ("$HTML_DIRECTORY/done/$SUBMISSION_ID") or die "can not create submission $SUBMISSION_ID folder"; 
	mkdir ("$HTML_DIRECTORY/done/$SUBMISSION_ID/$RANDOM_PASS") or die "can not remove submission $SUBMISSION_ID password $RANDOM_PASS folder";
	
	open (WAIT, ">$HTML_DIRECTORY/done/$SUBMISSION_ID/$RANDOM_PASS/index.html") or die "can not create file index.html";
	print WAIT $string;
	close (WAIT);
	system("chmod 777 $HTML_DIRECTORY/done/$SUBMISSION_ID");
	system("chmod 777 $HTML_DIRECTORY/done/$SUBMISSION_ID/$RANDOM_PASS");
	system("chmod 777 $HTML_DIRECTORY/done/$SUBMISSION_ID/$RANDOM_PASS/index.html");
}

sub executeProgram {
	my $sc = shift;
	my $pid = fork ();
	if ($pid) {	#parent process where pid=child
		1;
	} elsif ($pid == 0) {	#child process
		open STDIN,  '<', '/dev/null';		#these three lines are absolutely necessary!!!
		open STDOUT, '>', '/dev/null';		# so that the parent do not wait for child to close input/output (this is a Perl CGI issue)
		open STDERR, '>&STDOUT';
		system($sc) and die "Can't run system commmand $sc!!";
		exit;
	} else {
		die "Fork process failed:$!\n";
	}
}

sub countConcurrentProcess {
	my $program = File::Basename::basename ($0);
	my $ps = qx/ps aux/;
	my $count = 0;
	while ($ps =~ m/^(\S+\s+){10}perl\s+(\S+)/gm) {
		my $found = File::Basename::basename ($2);
		if ($program eq $found) {
			$count++;
		}
	}
	return $count;
}

sub checkUnprocessedSubmission {
	my %processed;
	my @unprocessed;
	
	open (FH, "$WORK_DIRECTORY/processed_id") or die "Error: cannot read processed_id\n";
	while (<FH>) {
		chomp;
		$processed{$_}++;
	}
	close (FH);
	
	my $dh;
	opendir ($dh, $WORK_DIRECTORY) or die "Error: cannot open directory for reading\n";
	while (my $dir = readdir ($dh)) {
		if (-d "$WORK_DIRECTORY/$dir" and $dir =~ m/^\d+$/) {
			$processed{$dir} or push @unprocessed, $dir;
		}
	}
	closedir ($dh);
	return @unprocessed;
}

sub parallelProcessSubmission {
	my ($subroutine, $maxjob, $sleeptime, $totaltime) = @_;
	my %running_process;
	my $ccp = countConcurrentProcess ();
	$ccp >= 2 and print STDERR "NOTICE: Another process is running. Exit current process.\n" and return;
	my $pretime = time;
	
	while (1) {
		my @unprocessed = sort {$a<=>$b} checkUnprocessedSubmission ();
		print STDERR "Unprocessed submission: @unprocessed. Running process: ", join (" ", keys %running_process), "\n";

		for my $nextpid (keys %running_process) {
			if (waitpid ($nextpid, WNOHANG)) {		#Use waitpid with the WNOHANG option. This way it's not going to suspend the parent process and will immediately return 0 when the child has not yet exited. In your main loop you'll have to periodically poll all the children (tasks).	
				delete $running_process{$nextpid};
				print STDERR "Child process $nextpid done\n";
			}
		}
						
		if (keys %running_process < $maxjob and @unprocessed) {
			my $pid = fork ();
			if ($pid) {		#parent process where pid=child
				$running_process{$pid}++;
			} elsif ($pid == 0) {	#child process
				print STDERR "Processing submission $unprocessed[0]\n";
				#open STDIN,  '<', '/dev/null';		#these three lines are absolutely necessary!!!
				#open STDOUT, '>', '/dev/null';		# so that the parent do not wait for child to close input/output (this is a Perl CGI issue)
				#open STDERR, '>&STDOUT';
				my $newid = shift @unprocessed;
				&$subroutine ($newid);
				exit;
			} else {
				die "Fork process failed:$!\n";
			}
		}
		
		sleep ($sleeptime);
		my $curtime = time;
		if (not %running_process and not @unprocessed and $curtime-$pretime >= $totaltime) {
			last;
		}
	}
}

1;