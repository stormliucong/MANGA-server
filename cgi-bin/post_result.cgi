#!/usr/bin/perl
use warnings;
use strict;
use CGI;
use CGI::Carp qw(fatalsToBrowser);
use GenomicsServer qw(:COMPLETE :DEFAULT);
my $datestring = gmtime();
my $q = new CGI;
my $email = $q->param("email");
my $phenotype = $q->param("phenotype");
my $disease = $q->param("disease");
my $gene = $q->param("gene");
my $confidence = $q->param("confidence");
setupVariable('yanghui@usc.edu', '/var/www/html/loh','http://phenolyzer.usc.edu');
if ($email){
	GenomicsServer::verifyEmail($email,$q);
	open(my $fh, ">>$LIB_DIRECTORY/custom_db/DB_CUSTOM_GENE_DISEASE") or die;
	flock ($fh,2);
	print $fh join("\t", ($datestring, $email, $phenotype, $disease, $gene, $confidence))."\n";
	flock ($fh,8);
	close($fh);
	
}

my $cgi_error = $q->cgi_error;
#system("kill 3049");
if ($cgi_error) {
	print $q->header(-status=>$cgi_error), 
		$q->start_html('ERROR'),
		$q->h2('Request not processed'),
		$q->strong($cgi_error);
	exit (0);
}


print  $q->header("text/html");
open(my $fh, "$HTML_DIRECTORY/post_result_template.html") or die;
my $template = "";
for (<$fh>){
	$template .= $_;
}
close($fh);
my $table_str = qq|<table class="table table-bordered">
<tr><th>Date</th><th>Email</th><th>Phenotype</th><th>Disease</th><th>Gene</th><th>Confidence</th></tr>|;
open(my $fh2, "$LIB_DIRECTORY/custom_db/DB_CUSTOM_GENE_DISEASE") or die;
for (<$fh2>){
	next if($_=~/^\W$/);
	s|\t|</td><td>|g;
	$_ = "<tr><td>$_</td></tr>";
	$table_str .= $_;
}
close($fh);

$table_str .= qq|</table>|;

$template =~s/%%%%Content%%%%/$table_str/;
if($email){
	my $script = qq|<script>
    	window.location.replace("http://phenolyzer.usc.edu/cgi-bin/post_result.cgi");
    	</script>|;
	$template=~s/%%%%script%%%%/$script/;	
}
else{
	$template=~s/%%%%script%%%%//;	
}
print $template;



	

