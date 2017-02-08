#!/usr/bin/perl
use warnings;
use strict;
use CGI;
use CGI::Carp qw(fatalsToBrowser);
use POSIX ":sys_wait_h";

#define global variables
our $CARETAKER = "kaichop\@gmail.com";
our $SERVER_DIRECTORY = "/var/www/html/loh";
our $HTML_DIRECTORY = "${SERVER_DIRECTORY}/html";
our $BIN_DIRECTORY = "${SERVER_DIRECTORY}/bin";
our $LIB_DIRECTORY = "${SERVER_DIRECTORY}/lib";
our $WORK_DIRECTORY = "${SERVER_DIRECTORY}/work";
our $SUBMISSION_ID_FILENAME = "${WORK_DIRECTORY}/submission_id"; #file stores the submission id

##########################################################################

$SIG{CHLD} = 'IGNORE';

my $q = new CGI;

#THE FOLLOWING LINE IS REQUIRED FOR ANY OTHER OUTPUT SUCH AS ERROR OUTPUT FOR FEEDBACK OUTPUT
print $q->header ("text/html");
my $cgi_error = $q->cgi_error;
if ($cgi_error) {
	if ($cgi_error eq "413 Request entity too large") {
		display_error ("Unable to process the information you supplied: $cgi_error! We can not handle files over 200Mb (gz/zip is okay), please download ANNOVAR to perform your analysis", $CARETAKER);
	} else {
		display_error ("Unable to process the information you supplied: $cgi_error!", $CARETAKER);
	}
}

#parse the web form at <http://annovar.usc.edu>
my $ip = $q->param('ip');
my $host = $q->param('host');
my $email = $q->param('email');
if ($email and $email !~ /^(\w|\-|\_|\.)+\@((\w|\-|\_)+\.)+[a-zA-Z]{2,}$/) {
	display_error("Please enter a valid email address", $CARETAKER);
}

my $buildver = $q->param('buildver');
my $bedfile = $q->param('bedfile');
my $bedfile_fh = $q->upload ('bedfile');



my $submission_time = scalar (localtime);
my $submission_id;
my $warning_message = '';
my $weblink;

prepareWorkDirectory ();

generateFeedback ($submission_id, $submission_time, $weblink, $warning_message);

executeProgram ();

sub executeProgram {

        if ($email eq 'kaichop@gmail.com') {
        	1;
        } else {
		my $pid = fork ();
		if ($pid) {	#parent process where pid=child
			1;
		} elsif ($pid == 0) {	#child process
			open STDIN,  '<', '/dev/null';		#these three lines are absolutely necessary!!!
			open STDOUT, '>', '/dev/null';		# so that the parent do not wait for child to close input/output (this is a Perl CGI issue)
			open STDERR, '>&STDOUT';
			exec("$BIN_DIRECTORY/control_loh.pl $submission_id 2> $WORK_DIRECTORY/$submission_id/tempfile");
			exit;
		} else {
			confess "Fork process failed:$!\n";
		}
	}
}
	
sub prepareWorkDirectory {
        -d $WORK_DIRECTORY or confess "Error: work directory $WORK_DIRECTORY does not exist";
        -f $SUBMISSION_ID_FILENAME or confess "Error: submission_id file does not exist in work directory $WORK_DIRECTORY";

        open (SUBMISSION_ID, $SUBMISSION_ID_FILENAME) or confess "Error: cannot open submission_id file $SUBMISSION_ID_FILENAME in work directory $WORK_DIRECTORY: $!";
        flock SUBMISSION_ID, 1;
        $submission_id = <SUBMISSION_ID>;
        flock SUBMISSION_ID, 8;
        close (SUBMISSION_ID);
        $submission_id++;
        open (SUBMISSION_ID, ">$SUBMISSION_ID_FILENAME") or confess "Error: cannot write submission_id file in work directory $WORK_DIRECTORY: $!";
        flock SUBMISSION_ID, 2;
        print SUBMISSION_ID $submission_id;
        flock SUBMISSION_ID, 8;
        close (SUBMISSION_ID);
        
	#Xiao added the following line to generate the result link ahead of running annovar.
	my $maxLenth=16;
        my @a = (0..9,'a'..'z','A'..'Z','-','_');
        my $password = join '', map { $a[int rand @a] } 0..($maxLenth-1);        
        $weblink = qq (http://phenolyzer.wglab.org/done/$submission_id/$password/index.html) ;
               
	mkdir ("$WORK_DIRECTORY/$submission_id") or confess "Error: cannot generate submission directory for submission id $submission_id: $!";
	chmod 0777, "$WORK_DIRECTORY/$submission_id" or confess "Error: unable to set the permission of directories: $!";
	
	my $orig_file = "$WORK_DIRECTORY/$submission_id/query.bed";
	open (BED, ">$orig_file") or confess "Error: cannot write query.orig.vcf file: $!";
        while (<$bedfile_fh>) {
                print BED;
        }
        close (BED);

  	  	
  	open (INFO, ">$WORK_DIRECTORY/$submission_id/info") or confess "Error: cannot write info file: $!";
        print INFO "email=$email\nsubmission_time=$submission_time\npassword=$password\nbuildver=$buildver\nbedfile=$bedfile\n";
        my @genelist;
        $q->param('cancer') and push @genelist, "cancer.txt";
        $q->param('blindness') and push @genelist, "blindness.txt";
        $q->param('deafness') and push @genelist, "deafness.txt";
        $q->param('anemia') and push @genelist, "anemia.txt";
        $q->param('intellectualdisability') and push @genelist, "intellectualdisability.txt";
        if ($q->param('userphen')) {
        	open (USERPHEN, ">$WORK_DIRECTORY/$submission_id/userphen.txt") or die "Error: cannot write to user phenotype file: $!\n";
        	my @phen = split (/[\s+,]+/, $q->param('userphen'));
        	@phen = map {m/^[\w\-]+$/} @phen;
        	print USERPHEN join ("\n", @phen), "\n";
        	close (USERPHEN);
        	system ("fgrep -w -f $WORK_DIRECTORY/$submission_id/userphen.txt $LIB_DIRECTORY/genekey > $WORK_DIRECTORY/$submission_id/userphengene.txt");
        	push @genelist, "userphengene.txt";
        }
        if ($q->param('usergene')) {
        	open (USERGENE, ">$WORK_DIRECTORY/$submission_id/usergene.txt") or die "Error: cannot write to user gene file: $!\n";
        	my @gene = split (/[\s+,]+/, $q->param('usergene'));
        	print USERGENE join ("\n", @gene), "\n";
        	close (USERGENE);
        	push @genelist, "usergene.txt";
        }
        
        print INFO "genefile=", join (",", @genelist), "\n";
        close (INFO);


        if (-e "$HTML_DIRECTORY/done/$submission_id") {
        	system ("rm -rf $HTML_DIRECTORY/done/$submission_id") and confess "can not remove submission $submission_id folder";
        }
        mkdir ("$HTML_DIRECTORY/done/$submission_id") or confess "can not create submission $submission_id folder"; 
        mkdir ("$HTML_DIRECTORY/done/$submission_id/$password") or confess "can not remove submission $submission_id password $password folder";
        
        open (WAIT, ">$HTML_DIRECTORY/done/$submission_id/$password/index.html") or confess "can not create file index.html";
        print WAIT "<html><META HTTP-EQUIV=refresh CONTENT=60><p>Your submission is being processed and will be available at this page after computation is done. This page will refresh every 60 seconds. </p></html>";
        close (WAIT);
        system("chmod 777 $HTML_DIRECTORY/done/$submission_id");
        system("chmod 777 $HTML_DIRECTORY/done/$submission_id/$password");
        system("chmod 777 $HTML_DIRECTORY/done/$submission_id/$password/index.html");
}


sub generateFeedback {
	my ($submission_id, $submission_time, $weblink, $warning_message) = @_;

	
	my $submission_summary = <<SUMMARY;
<h1> Submission received </h1>
<hr>
<p>Your submission ID <b>$submission_id</b> has been received by us at <b>$submission_time</b>. </p><p>The results will be generated at <a href="$weblink"><b>$weblink</b></a> after the computation is done.</p>
<P>$warning_message</p>
SUMMARY

	print $submission_summary;
}

sub display_error
{
	my ($error_message, $email_address) = @_;
	
	my $submission_summary = "<h3> ERROR: $error_message </h3><hr><p> If this is not the expected result, please notify <var><a href=\"mailto:$email_address\">$email_address</a></var> of this error. Thank you.</p>\n";
	print $submission_summary;
	exit(0);
}


