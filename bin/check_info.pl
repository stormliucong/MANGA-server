use strict;
use warnings;
use DateTime;
use DateTime::Format::Strptime;
my $parser = DateTime::Format::Strptime->new(
    pattern => '%a %b %d %H:%M:%S %Y'
);
opendir(DIR1,"../work") or die;
opendir(DIR2,"../html/done") or die;
my @folders1 = readdir(DIR1);
my @folders2 = readdir(DIR2); 
@folders1 = map {"../work/".$_; } grep {/^\d+$/ ;} @folders1;
@folders2 = map {"../html/done/".$_; } grep { /^\d+$/;} @folders2;
my @folders = (@folders1, @folders2);
@folders = sort { $a=~ /\/(\d+)$/;
	              my $word1 = $1;
	              $b=~ /\/(\d+)$/;
	              my $word2 = $1;
	              $word2 <=> $word1; } @folders;
closedir(DIR1);
closedir(DIR2);
open(OUTPUT, ">phenolyzer_info.txt");
print OUTPUT join("\t", qw/ID TIME EMAIL PHENOTYPE IP URL/)."\n";

for my $folder ( @folders ){
	 next unless($folder =~ /\/(\d+)$/);
	 my $id = $1;
	 my %info;
     open(INFO, $folder."/info") or next;        	 	
	 for(<INFO>)
	 {
	 	chomp();
	 	my($key, $content) = split("=");
	 	$info{$key} = $content;
	 }
	 #next if($info{"email"} eq 'yanghui@usc.edu');
	 open(DISEASE, $folder."/disease_list.txt");
	 my $disease = join(";", map {chomp();$_; } <DISEASE>);
	 close(DISEASE);
	 my $dt = $parser->parse_datetime($info{'submission_time'});
	 my $time = $dt->strftime('%F');
	 $info{'email'} = "NA" if (not $info{'email'});
	 $info{'ip'} = "NA" if (not $info{'ip'});
	 my $url = "http://phenolyzer.usc.edu/done/$id/$info{'password'}";
	 print OUTPUT join("\t", ($id, $time, $info{'email'}, $disease, $info{'ip'}, $url))."\n";
     close(INFO);
}
system("R CMD BATCH server_analysis.R") and die;



