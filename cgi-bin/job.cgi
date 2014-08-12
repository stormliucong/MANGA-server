#!/usr/bin/perl
use warnings;
use strict;
use CGI;
use CGI::Carp qw(fatalsToBrowser);
use GenomicsServer qw(:COMPLETE :DEFAULT);

my $q = new CGI;

my $cgi_error = $q->cgi_error;
if ($cgi_error) {
	print $q->header(-status=>$cgi_error), 
		$q->start_html('ERROR'),
		$q->h2('Request not processed'),
		$q->strong($cgi_error);
	exit (0);
}

setupVariable('yanghui@usc.edu', '/var/www/html/loh','http://phenolyzer.usc.edu');
my $markerfile="query.table";
my %jobstatus=GenomicsServer::jobMonitor($markerfile);
print  $q->header("text/html"),
       $q->start_html(-title=>"Job Monitor", -style=>{-src=>"$WEBSITE/job.css"});
      print <<EOF;
  
      <h1> Job Monitor </h1>
         <table>  
      <th>JOB ID</th> 
          <th>STATUS</th>
EOF

          
 foreach (sort {$a<=>$b} keys %jobstatus)
 { print "<tr><td width = '300'>$_</td><td width = '300'>$jobstatus{$_}</td></tr>";}
      print "</table>";
      print $q->end_html;
	

