use warnings;
use strict;
use GenomicsServer;
GenomicsServer::setupVariable ('yanghui@usc.edu', '/var/www/html/loh','http://phenolyzer.usc.edu');
deleteOldFiles();

sub deleteOldFiles {
	 my @file_list = split("\n",`ls $HTML_DIRECTORY/done`);
	 my $days=30;
	 for my $file (@file_list)
	 {
	 	my $file_days = -M "$HTML_DIRECTORY/done/$file";
	    #print STDERR $file."\t".$file_days."\n";	
	 	if( ($file_days>$days) and (-d "$HTML_DIRECTORY/done/$file"))
	 	{	 	
	    next if($file eq "4738" or $file eq "4737" or $file eq "4736" or $file eq "4735" or $file eq "5620");			
	 	system("rm -rf $HTML_DIRECTORY/done/$file") and warn "WARNING:Can't remove old files in $HTML_DIRECTORY/done/$file \n"  ;
	 	print STDERR "Delete $file succesfully! \n";
	 	}
	 }
}