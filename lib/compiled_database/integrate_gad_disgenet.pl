use strict;
open (DIS_GEN_NET, "../DisGenNet_Curated.txt") or die;
open (GAD, "../GAD_gene_disease.txt") or die;
open (GENE_ID, "./DB_HUMAN_GENE_ID") or die;
open (TRAINING, ">DB_DISGENET_GENE_DISEASE_SCORE") or die;
open (TESTING,  ">DB_GAD_GENE_DISEASE_SCORE") or die;
my $i=0;
my %gene_transform;
for my $line (<GENE_ID>)
{
	if($i==0) { $i++;next;  }
	chomp($line);
	my ($id, $gene, $synonyms) = split("\t", $line);
		$gene_transform{$gene} = uc $gene;
		$gene_transform{uc $gene} = uc $gene;
		$gene_transform{$id} = uc $gene;
}
seek GENE_ID, 0,0;
$i=0;
for my $line (<GENE_ID>)
{
	if($i==0) { $i++;next;  }
	chomp($line);
	my ($id, $gene, $synonyms) = split("\t", $line);
	if($synonyms eq "-") {
		next;
	}
	else {
		my @synonyms = split('\|', $synonyms);
		for my $each (@synonyms)
		{
				$gene_transform{uc $each} = uc $gene if(not defined $gene_transform{$each});
		};
	}
}


open (TESTING_INDEX, ">TESING_INDEX");
my %repeat_check = ();
my $i=0;
for my $line (<DIS_GEN_NET>){
	if($i==0) {$i++; next;}
	chomp($line);
	my @words = split("\t", $line);	
	my ($gene, $disease, $score, $disease_id) = @words[6,9,1,8];
	$disease =~s/"//g;
	 $disease = TextStandardize($disease);
	$gene=$gene_transform{uc $gene};
	my $repeat_line = join ("\t", ($gene, $disease_id, $score, "DISGENET"));
    my $output = join ("\t", ($gene, $disease, $disease_id, $score, "DISGENET"));
    print TRAINING $output."\n" if ($score and not $repeat_check{$repeat_line});
    $repeat_check{$repeat_line} = 1;
}
$i=0;
my %conflict_check = ();
for my $line (<GAD>){
    if($i<=2) {$i++; next;}	
	chomp($line);
	my @words = split("\t", $line);
	my ($gene, $disease, $if_association,$pubmed_id,$omim_id) = @words[8,2,1,13,29];
	$gene=$gene_transform{uc $gene};
	$pubmed_id;
	$omim_id = "OMIM:".$omim_id;
	my @diseases = split('\|',$disease);
	$disease = $diseases[0];
	$disease =~s/"|('s?)//g;
	$disease =~s/\bII\b/2/g;
	$disease =~s/\bIII\b/3/g;
	$disease =~s/\bI\b/1/g;
	 $disease = TextStandardize($disease);
	 $disease = lc $disease;
	if($if_association and $gene and $disease!~/^\W*$/ and $pubmed_id >0 )
	{	
		next if($if_association !~ /^Y$/);
		my $gene_disease = join("\t",($gene,$disease));
        $conflict_check{$gene_disease} = $pubmed_id  if (not $conflict_check{$gene_disease});
        $conflict_check{$gene_disease}.= ", ".$pubmed_id  if ( $conflict_check{$gene_disease}); 
       		
	};
 } 
 my @output;
 my %disease_check = ();
 $i = 0;
 for my $each (keys %conflict_check){
 	 push @output, join("\t",($each, "PUBMED:".$conflict_check{$each}, 0.25, "GAD"));
     my ($gene, $disease) = split("\t", $each);
     $i+=1 and $disease_check{$disease}{"index"} = sprintf('%04s',$i) if(not $disease_check{$disease}{"index"});
     if( not $disease_check{$disease}{"count"})
     {
     $disease_check{$disease}{"count"} = 1; 
     }
 	 else{
 	 $disease_check{$disease}{"count"} +=1;	
        }
 	
 }
 
 
@output = sort {my @words1 = split("\t",$a);
 	            my @words2 = split("\t",$b);
 	             $words1[1].$words1[2] cmp $words2[1].$words2[2]; }  @output;
 	 print TESTING $_."\n" for (@output);
@output = sort { $disease_check{$b}{"count"} <=> $disease_check{$a}{"count"};  
	                   }  keys %disease_check;
 	 print TESTING_INDEX $_."\t".$disease_check{$_}{"count"}."\t".$disease_check{$_}{"index"}."\n" for (@output);
 	 
 	 
sub TextStandardize {
	my $word=$_[0];
	$word=~s/^\W*(.*?)\W*$/$1/;
	$word=~s/\W+/ /g;
	$word=~s/'s\b//g;
	return $word;
} 
 	 
 	 
 	 
 	 
 	 