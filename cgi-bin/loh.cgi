#!/usr/bin/perl
use warnings;
use strict;
use CGI;
use CGI::Carp qw(fatalsToBrowser);
use GenomicsServer qw(:COMPLETE :DEFAULT);

##########################################################################

$CGI::POST_MAX=200_000_000; 		# Limit post to 200MB file size

$SIG{CHLD} = 'IGNORE';		#Setting $SIG{CHLD} to "IGNORE" has the effect of not creating zombie processes when the parent process fails to wait() on its child processes (i.e., child processes are automatically reaped). 

my $q = new CGI;

my $cgi_error = $q->cgi_error;
if ($cgi_error) {
	print $q->header(-status=>$cgi_error), 
		$q->start_html('ERROR'),
		$q->h2('Request not processed'),
		$q->strong($cgi_error);
	exit (0);
}

my $ip = $q->param('ip');
my $host = $q->param('host');
my $email = $q->param('email');
my $if_region = $q->param('region_selection');
my $if_genelist=$q->param('gene_selection');
my $if_weight_adjust = $q->param('weight_adjust');
my $wordcloud = $q->param("wordcloud");
my ($buildver, $bedfile, $bedfile_fh, $genelist);
my ($omim, $clinvar, $orphanet, $gwas, $gene_reviews);
my ($hprd, $biosystem, $hgnc, $htri);
if($if_region eq "yes")
{
  $buildver = $q->param('buildver');
  $bedfile  = $q->param('bedfile');
  $bedfile_fh = $q->upload ('bedfile');
}
if($if_genelist eq "yes")
{
  $genelist=$q->param('genelist');
}
if($if_weight_adjust eq 'yes')
{
   $gwas = $q->param('GWAS');
   $omim = $q->param('OMIM');	
   $clinvar = $q->param('CLINVAR');
   $gene_reviews = $q->param('GENE_REVIEWS');
   $orphanet = $q->param('ORPHANET');
   $hprd = $q->param('HPRD');
   $biosystem = $q->param('BIOSYSTEM');
   $hgnc = $q->param('HGNC');
   $htri = $q->param('HTRI');
}
my $coba = $q->param('coba');
my $disease= $q->param("disease");
my $options= $q->param("other_options");


$options eq "all_diseases" or $disease!~/^\W*$/  or die "No disease input is detected!!! $options";

GenomicsServer::verifyEmail($email,$q);
GenomicsServer::setupVariable ('yanghui@usc.edu', '/var/www/html/loh','http://phenolyzer.usc.edu');
GenomicsServer::prepareWorkDirectory ();
#---------------------------------------------generate priliminary result----------------------


GenomicsServer::generatePrelimResult ("<html><META HTTP-EQUIV=refresh CONTENT=10><p>Your submission is being processed and will be available at this page after computation is done. This page will refresh every 10 seconds. </p></html>");

my $submission_time = scalar (localtime);
my $submission_id = $SUBMISSION_ID;
my $password = $RANDOM_PASS;
my $warning_message = '';
my $weblink;
my ($total_disease_num,$legal_disease_num,$total_gene_num,$legal_gene_num)=(0,0,0,0);

writeInfoFile ();
generateFeedback ($q, $submission_id, $password, $warning_message);

#GenomicsServer::executeProgram ("$CGI_DIRECTORY/serve_loh.pl -id $submission_id 2> $WORK_DIRECTORY/$submission_id/error_log");

GenomicsServer::executeProgram("perl $CGI_DIRECTORY/serve_loh.pl 2> $WORK_DIRECTORY/serve_loh_error_log") ;

sub writeInfoFile {
	
	if($bedfile){
	my $orig_file = "$WORK_DIRECTORY/$submission_id/query.bed";
	open (BED, ">$orig_file") or confess "Error: cannot write query_bed file: $!";
        while (<$bedfile_fh>) {
                print BED;
        }
        close (BED);
	}
  	open (INFO, ">$WORK_DIRECTORY/$SUBMISSION_ID/info") or confess "Error: cannot write info file: $!";
  	    print INFO "ip=$ip\nhost=$host\n";
        print INFO "email=$email\nsubmission_time=$submission_time\npassword=$password\nbuildver=$buildver\nbedfile=$bedfile\n";
        ($options eq "all_diseases")?print INFO "all_diseases=yes\n":print INFO "all_diseases=no\n";
        ($options eq "full_expand")?print INFO "full_expand=yes\n":print INFO "full_expand=no\n"; 
        ($options eq "phenotype_interpretation")? print INFO "phenotype_interpretation=yes\n":print INFO "phenotype_interpretation=no\n";
        print INFO "coba=yes\n" if($coba);
        print INFO "wordcloud=yes\n" if($wordcloud eq 'yes');
         #If all_diseases are queried, there is no need to write the disease list
        if($options ne "all_diseases")
        {                           
        my @genelist;
        if (defined $disease) {
        	open (DISEASES, ">$WORK_DIRECTORY/$submission_id/disease_list.txt") or die "Error: cannot write to user phenotype file: $!\n";
        	my @disease_list = split (qr/[^ _,\w\.\-'\(\)\[\]\{\}]+/,lc $disease);
            $total_disease_num=@disease_list;
        	$legal_disease_num=0;
        	for my $individual_term(@disease_list){
        	if($individual_term=~/^\W*$/){next;}
        	$legal_disease_num++;
            $individual_term=~s/^\W*(.*?)\W*$/$1/;                 #Get rid of the whitespaces in the beginnning and end
            $individual_term=~s/\s+/ /g;
            print DISEASES $individual_term."\n";
        	}
        	close (DISEASES);
        	print INFO "disease_file=disease_list.txt\n";
        	print INFO "total_disease_num=$total_disease_num\n";
        	print INFO "legal_disease_num=$legal_disease_num\n";
        }
        }
        else 
        {
        	open (DISEASES, ">$WORK_DIRECTORY/$submission_id/disease_list.txt") or die "Error: cannot write to user phenotype file: $!\n";
        	print DISEASES "all_diseases";
        	print INFO "disease_file=disease_list.txt\n";
        }
        if ($genelist) 
        {
        	open (GENE, ">$WORK_DIRECTORY/$submission_id/gene_list.txt") or die "Error: cannot write to user gene file: $!\n";
        	my @genes=split(qr/[^_\w\.\-]+/m,$genelist);
        	$total_gene_num=@genes;
        	$legal_gene_num=0;
        	for my $individual_term(@genes){
            if($individual_term=~/^\W*$/){next;}
            $legal_gene_num++;
            $individual_term=~s/^\W*(.*?)\W*$/$1/;                 #Get rid of the whitespaces in the beginnning and end
            print GENE $individual_term."\n";
        }
            print INFO "gene_file=gene_list.txt\n";
            print INFO "total_gene_num=$total_gene_num\n";
            
        }
       
        if($if_weight_adjust eq 'yes')
       {
            print INFO "user_defined_weight=yes\n";
            print INFO "GWAS_WEIGHT=$gwas\n";
            print INFO "OMIM_WEIGHT=$omim\n"; 	
            print INFO "CLINVAR_WEIGHT=$clinvar\n";
            print INFO "GENE_REVIEWS_WEIGHT=$gene_reviews\n";
            print INFO "ORPHANET_WEIGHT=$orphanet\n";
            print INFO "HPRD_WEIGHT=$hprd\n";
            print INFO "BIOSYSTEM_WEIGHT=$biosystem\n";
            print INFO "HGNC_WEIGHT=$hgnc\n";
            print INFO "HTRI_WEIGHT=$htri\n";
        }
        
        close (INFO);
}


sub generateFeedback {
	
	my ($q, $submission_id, $password, $warning_message) = @_;
	my $preliminary_page=();
	$weblink="http://phenolyzer.usc.edu/done/$submission_id/$password/index.html";
	my $template_file;
	$template_file=$coba?"template_coba.php":"template.php";
open(TEMPLATE,"$HTML_DIRECTORY/$template_file");
my $replace_message=();
$replace_message.=qq|<h3 class="page-header text-primary"> Submission $SUBMISSION_ID </h3>|;
$replace_message.=$q->p ("Your submission ID <b>$SUBMISSION_ID</b> has been received by us at <b>$submission_time</b>.");
$replace_message.=$q->p (qq#The results will be generated at<br><br> <a href="$weblink"><b>$weblink</b></a> <br>#);
$replace_message.=$q->p ("You entered <b>$legal_disease_num</b> disease terms\n");
$replace_message.=$q->p ("You entered <b>$legal_gene_num</b> gene terms\n");
$replace_message.= $q->p ($warning_message);

for my $line (<TEMPLATE>){
     $preliminary_page.=$line;
}
$preliminary_page=~s/%%%%Content%%%%/$replace_message/;
print $q->header("text/html");
print $preliminary_page;
}



