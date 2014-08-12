use strict;
BEGIN{
push @INC,"/home/huiyang/perl5/lib/perl5";
}
use JSON;
if (-f "out.annotated_gene_scores")
{  open (DATA, "out.annotated_gene_scores");  }
else{
open (DATA, "out.predicted_gene_scores");
}
open (OUTPUT, ">network.json");

my $i=0;
my $gene="";

my %gene_check =();
my %edge_check =();
my %term_check =();
my %disease_score = ();

my (@gene_nodes, @edges, @edges_output,@disease_nodes, @term_nodes );
my ($max_score_reported, $max_score_predicted, $max_score) = (0,0,0);
my ($min_score_reported, $min_score_predicted, $min_score) = (10,10,10);
my ($min_edge_score, $max_edge_score) = (10,0);
my ($min_disease_score, $max_disease_score) = (10,0);

my $MAX_COUNT = 50;
my $gene_count = 0;
for my $line (<DATA>)
{
	my $status;
	if($i==0) {$i++; next;}
    if($gene_count >= $MAX_COUNT) {next;}
	chomp($line); 
	if($line =~ /^\s*$/)
	{
 	$gene=""; next;
	}
	#Generate Gene_nodes  
	    if(not $gene)
	    {
		my %gene_nodes=();
		
	    my @words = split("\t",$line);
	    my $score = $words[2];
	    my @genes = split(",", $words[0]);
	       $gene  = $genes[0];
	       $gene_check{$gene} = 1;
	       $words[1] =~/^ID:\d*.*?(Reported|Predicted)$/;
	       $gene_count++;  
		   $status = $1; 
		   	 
	    $gene_nodes{"data"}{"id"} = $gene;
	    $score += 0;
        $max_score_reported = $score if($score>$max_score_reported and $status eq "Reported");
	    $max_score_predicted = $score if($score>$max_score_predicted and $status eq "Predicted");
	    $max_score = $score if ( $score > $max_score);
	    
	    $min_score_reported = $score if($score < $min_score_reported and $status eq "Reported");
	    $min_score_predicted = $score if($score < $min_score_predicted and $status eq "Predicted");
	    $min_score = $score if ( $score < $min_score);
	    
	    $gene_nodes{"data"}{"weight"} = $score;
	    $gene_nodes{"data"}{"color_weight"} = $score;
	    $gene_nodes{"classes"} = "$status gene";
	    $gene_nodes{"group"} = "nodes";
	    push @gene_nodes,\%gene_nodes; 
	    
        }
       #Generate Gene_Edges 
       else
       {
       	#next if($line =~/GENE_FAMILY/);
       	my %gene_edge=();
       	if($line =~ /((BIOSYSTEM)|(HPRD)|(GENE_FAMILY)|(HTRI))/  )
       	{
       	my $interaction = $1;
       	my @words = split("\t",$line);
       	my ($target_gene, $source_gene);
       	if($words[0]!~/HTRI/)
       	{
       	$words[2] =~ /With ([\S]+)/;
       	$target_gene = $1;
       	$source_gene = $gene;
       	}
       	else
       	{
           if($words[2] =~ /Regulated by ([\S]+)/i)	
       	   {
       	   	$target_gene = $gene;
       		$source_gene = $1;
       		 
           }
       	   if($words[2] =~ /Regulates ([\S]+)/i)
       	   {       	   	  
       	   	  $target_gene = $1;
       	   	  $source_gene = $gene;
       	   }
       	}
       	my $score = $words[3];
       	$gene_edge{"data"}{"id"} = "$gene with $target_gene";
       	$gene_edge{"classes"} = "$interaction gene";
       	$gene_edge{"group"} = "edges";
    	$gene_edge{"data"}{"weight"} = $score;
    	
    	if($edge_check{$source_gene}{$target_gene}{$interaction} or $edge_check{$target_gene}{$source_gene}{$interaction})
         {
         if($interaction ne 'HTRI'){next;}
         else{
         	next if ($edge_check{$source_gene}{$target_gene}{$interaction});       	
             }
         }
         else
         {
        	$edge_check{$source_gene}{$target_gene}{$interaction}=1;
        	
         }
          
    	$gene_edge{"data"}{"source"} = $source_gene;
    	$gene_edge{"data"}{"target"} = $target_gene;
    	

    	if($interaction =~/^(BIOSYSTEM)|(HPRD)$/)
    	{
       	$min_edge_score = $score if($score < $min_edge_score);
        $max_edge_score = $score if($score > $max_edge_score);
    	}
           
            push @edges,\%gene_edge; 
        }
        
        else
        {
        	my %disease_node =();
        	my %term_node = ();
        	my %disease_gene_edge = ();
        	my %disease_term_edge = ();
            next if ($status eq "Predicted");
            my ($source, $disease, $term, $score) = split("\t", $line);
            $disease = lc $disease;
            $disease =~s/-/ /g;
            
           	$disease_node{"data"}{"id"} = $disease;
           	$disease_node{"classes"} = "disease";
           	$disease_node{"group"} = "nodes";
            push @disease_nodes,\%disease_node   if(not $disease_score{$disease});
            $disease_score{$disease} += $score;
            
            $term_node{"data"}{"id"} = uc $term;
            $term_node{"classes"} = "term";
            $term_node{"group"} = "nodes";
            push @term_nodes,\%term_node  if ( not $term_check{$term});
            $term_check{$term} = 1;
            
            
            $disease_gene_edge{"data"}{"id"} = "$disease with $gene"; 
            $disease_gene_edge{"classes"} = "disease_gene";
            $disease_gene_edge{"group"} = "edges";
            $disease_gene_edge{"data"}{"source"} = $disease;
    	    $disease_gene_edge{"data"}{"target"} = $gene;
            push @edges_output, \%disease_gene_edge  if (not $edge_check{$disease}{$gene} );
    	    $edge_check{$disease}{$gene} = 1;
    	    
    	    $disease_term_edge{"data"}{"id"} = "$disease with $term";
    	    $disease_term_edge{"classes"} = "disease_term";
    	    $disease_term_edge{"group"} = "edges";
    	    $disease_term_edge{"data"}{"source"} = $disease;
       	    $disease_term_edge{"data"}{"target"} = uc $term; 	
            push @edges_output, \%disease_term_edge  if (not $edge_check{$disease}{$term} );    
            $edge_check{$disease}{$term} = 1;
          } 
     }
}
# For diseases, now assign each nodes weights
for my $each (@disease_nodes)
{          
	      my $score = $disease_score{$each->{"data"}{"id"}};
	      $each->{"data"}{"weight"} = $score;
          $max_disease_score = 	$score if ( $score > $max_disease_score);
          $min_disease_score = 	$score if ( $score < $min_disease_score);     
}  
my $diff_disease = $max_disease_score - $min_disease_score;
for my $each (@disease_nodes)
{          
	       if( $diff_disease)
	       {
	        $each->{"data"}{"weight"} -= $min_disease_score;
	        $each->{"data"}{"weight"} /= $diff_disease;  
	       }
	       else
	       {
	       	 $each->{"data"}{"weight"} = 1;
	       }
}
 
my $diff = $max_score - $min_score;
my $diff_reported = $max_score_reported - $min_score_reported;
my $diff_predicted = $max_score_predicted - $min_score_predicted;
my $diff_edge = $max_edge_score - $min_edge_score;
for (@gene_nodes)
{

	if ($_->{"classes"} eq "Reported gene"){
		if($diff_reported > 0)
		{
        $_->{"data"}{"color_weight"}-=$min_score_reported;
        $_->{"data"}{"color_weight"}/=$diff_reported;
		}
		else
		{
			$_->{"data"}{"color_weight"} = 1;
		}
	  	
	}
    if ($_->{"classes"} eq "Predicted gene")
    {
    	if($diff_predicted)
    	{
        $_->{"data"}{"color_weight"}-=$min_score_predicted;
        $_->{"data"}{"color_weight"}/=$diff_predicted;
    	}
        else
        {
        	$_->{"data"}{"color_weight"} = 1;
        }
    }
    if($diff)
    {
	$_->{"data"}{"weight"}-=$min_score;
	$_->{"data"}{"weight"}/=$diff;
    }
    else
    {
    	$_->{"data"}{"weight"} = 1;
    }
}
# Weight Normalization for the plot
for my $each (@edges)	
{	
	{
        if ( $gene_check{$each->{"data"}{"source"}} and $gene_check{$each->{"data"}{"target"}} ) 	 	
	  	{
	     if($diff_edge)
	     {
	  	 $each->{"data"}{"weight"}-=$min_edge_score;
	     $each->{"data"}{"weight"}/=$diff_edge;
         }
         else
         {
         $each->{"data"}{"weight"} = 1;	
         }
         push @edges_output, $each;
	   }
   }
}
my @output = ( @gene_nodes, @disease_nodes, @term_nodes, @edges_output);
my $json_text = to_json(\@output);
print OUTPUT $json_text;
