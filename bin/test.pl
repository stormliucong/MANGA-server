use File::stat;
use strict;
my $d=".";
my @file_list = split("\n",`ls $d`); 
 for my $file (@file_list)
	 {
	 	my $file_days = -M $file;
	 	print $file_days."\n";
	 }