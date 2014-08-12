#!/usr/bin/env perl
use warnings;
use strict;
use Pod::Usage;
use Getopt::Long;
use GenomicsServer;
use List::Util qw(max);


our ($verbose, $help, $man);
our ($id);

GetOptions ('verbose'=>\$verbose, 'help'=>\$help, 'man'=>\$man, 'id=i'=>\$id) or pod2usage ();

$help and pod2usage (-verbose=>1, -exitval=>1, -output=>\*STDOUT);
$man and pod2usage (-verbose=>2, -exitval=>1, -output=>\*STDOUT);
@ARGV and pod2usage (-verbose=>0, -exitval=>1, -output=>\*STDOUT);

GenomicsServer::setupVariable ('yanghui@usc.edu', '/var/www/html/loh','http://phenolyzer.usc.edu');
deleteOldFiles();
if (defined $id) {
	processSubmission ($id);	#process a specific submission and then quit
} else {
	my $subroutine = \&processSubmission;
	
	GenomicsServer::parallelProcessSubmission ($subroutine, 5, 5, 100);	#max simultaneous jobs=5, check status every 5 seconds, exit after 100 seconds
	

}

sub processSubmission {
        my ($id) = @_;
        my %info;
	my ($system_command);
	my ($failed_command);
	my $result_page = '';
	
	open (SUBMISSION_ID, ">>$PROCESSED_ID_FILENAME") or die "Error: cannot write processed_id file in work directory $WORK_DIRECTORY: $!";
	flock SUBMISSION_ID, 2;
	print SUBMISSION_ID "$id\n";
	flock SUBMISSION_ID, 8;
	close (SUBMISSION_ID);

	#enter the working directory, so that all temporary files are confined in this directory
	chdir ("$WORK_DIRECTORY/$id") or die "Error: cannot change to the desired directory $WORK_DIRECTORY/$id: $!";

	open (INFO, "info") or warn "Error: cannot read info file $WORK_DIRECTORY/$id/info: $!" and return;
	while (<INFO>) {
		chomp;
		my ($key, $value) = split ('=', $_);
		$info{$key} = $value;
	}
	close (INFO);

	#-f "email" and -s "email" and print STDERR "WARNING: skipping submission $id since it has been already executed (the $WORK_DIRECTORY/$id/email file exists)\n" and return;

        my $process_time = scalar (localtime);
        my ($email_header, $email_body, $email_tail);
	my $password = $info{"password"};
	
	$system_command = "perl $BIN_DIRECTORY/disease_annotation.pl -d $LIB_DIRECTORY/compiled_database -out out -prediction -w $BIN_DIRECTORY ";
	$system_command.="-f ";
	if($info{"user_defined_weight"})
	{
		$system_command.="-hprd_weight         $info{'HPRD_WEIGHT'} ";
        $system_command.="-biosystem_weight    $info{'BIOSYSTEM_WEIGHT'} ";             
        $system_command.="-gene_family_weight  $info{'HGNC_WEIGHT'} ";           
        $system_command.="-htri_weight         $info{'HTRI_WEIGHT'} ";
        $system_command.="-gwas_weight         $info{'GWAS_WEIGHT'} ";            
        $system_command.="-gene_reviews_weight $info{'GENE_REVIEWS_WEIGHT'} ";  
        $system_command.="-clinvar_weight      $info{'CLINVAR_WEIGHT'} ";                
        $system_command.="-omim_weight         $info{'OMIM_WEIGHT'} ";         
        $system_command.="-orphanet_weight     $info{'ORPHANET_WEIGHT'} ";
    }
    else{
	    $system_command.="-logistic ";
    }
	
	if($info{"disease_file"}){$system_command.="$info{disease_file} ";}
	if($info{"phenotype_interpretation"} eq "yes"){$system_command.="-phenotype ";}
	if($info{"full_expand"} eq "yes"){$system_command.="-e ";}
	
	if($info{"bedfile"}){
		$system_command.="-bedfile query.bed -buildver $info{buildver} ";
	}
	if ($info{"gene_file"}) {
	   $system_command.="-gene $info{gene_file} ";
	}
	$system_command .= " 2> query.disease_annotation.log";
	
	print STDERR "NOTICE: Running system command <$system_command>\n";
	system ($system_command) and $failed_command=$system_command;		#return value is negative (as a child process)
	$system_command = "perl $CGI_DIRECTORY/transform_to_json.pl";
	system ($system_command) and  $failed_command=$system_command;	
	
	if(-s "out.annotated_gene_scores"){
	open (RES, "out.annotated_gene_scores") or die "Error: cannot read result file out.annotated_gene_scores: $!\n";}
	else{
	open(RES,"out.predicted_gene_scores") or die "Error: cannot read result file out.merge_gene_scores: $!\n"; 
		}
	if(-s "out.annotated_gene_list" and -s "query.bed")
	{
		open(ANNOTATED_GENELIST, "out.annotated_gene_list") or die "ERROR:Can't open out.annotated_gene_list!\n";
		my %gene_hash =();
		while(<ANNOTATED_GENELIST>)
		{
			chomp();
			my @words = split("\t");
			my ($gene, $score) = @words[1,3];
			$gene_hash{$gene} = $score;
		}
		close(ANNOTATED_GENELIST);
		open(VARIANT, "out.variant_function") or die "ERROR:Can't open out.variant_function!\n";
		open(VARIANT_OUT, ">out.variant_prioritization") or die "ERROR:Can't open out.variant_prioritization!\n";
		my %variant_out = ();
		for(<VARIANT>)
		{
			chomp();
			my @words = split("\t");
			@words=@words[0..4];
			my @genes = split(",", $words[1]);
			$words[0]=~/exonic/ or next;
			my @scores = map {$gene_hash{$_};  } @genes; 
			my $key = join("\t",@words[2..4,1]);
			$variant_out{$key} = max(@scores);
		 
		}
		close(VARIANT);
		print VARIANT_OUT $_."\t".$variant_out{$_}."\n"  for (sort {$variant_out{$b} <=> $variant_out{$a};} keys %variant_out);
		
	}
		
	open (HTML, ">index.html") or die "can't write out index.html: $!";
	open (TEMPLATE, "$HTML_DIRECTORY/template_result.php") or die "$HTML_DIRECTORY/template.php does not exist!";
	open (GENE_REVIEWS, "$LIB_DIRECTORY/GeneReview_NBKid_shortname_OMIM.txt") or print STDERR "Can't open $LIB_DIRECTORY/GeneReview_NBKid_shortname_OMIM.txt\n";
	my %omim_to_gene_review = ();
	my $i=0;
	
	for(<GENE_REVIEWS>)           #make a hash to refer to gene review
	{
		$i++ and next if ($i==0);
		chomp;
		my ($id, $short_name, $omim) = split("\t");
		$omim_to_gene_review{$omim} = $id;
     }
	
	
	my @file_list=split("\n",`ls`);
	my @effective_term=();
	for(@file_list){
		if(m/^out_(\w+)_gene_scores$/){
			push @effective_term,$1;
		}
    }
    my $effective_term_num=@effective_term;
	my $replace_message;
	my $MAX_COUNT = 50;
	$result_page.=$_  for(<TEMPLATE>);
	#-------------------------------The real message for the out put-----------------------------
	$replace_message.=qq|<h2 class="result">Summary</h2>\n|;
	$replace_message.=qq|<p class="result">Dear Phenolyzer user, your submission (identifier: <b>$id</b>) was received at $info{submission_time} and processed at $process_time.</p>\n|;
	$replace_message.=qq|<h2 class="result">Submission information</h2><div class="sub_info">\n<ul>\n|;
	$replace_message.= "<li>bedfile=$info{bedfile}</li>\n" if $info{bedfile};
	$replace_message.= "<li>buildver=$info{buildver}</li>\n" if $info{bedfile};
	$replace_message.= "<li>all_diseases=$info{all_diseases}</li>\n";
	$replace_message.= "<li>full_expand=$info{full_expand}</li>\n";
	$replace_message.= "<li>phenotype_interpretation=$info{phenotype_interpretation}</li>\n";
	
	if($info{"all_diseases"} ne "yes")
	{
	$replace_message.="<li>$info{total_disease_num} disease terms have been entered, among which, $effective_term_num terms have corresponding records in our database.</li>\n";
	if($effective_term_num)
	{
	$replace_message.=qq|<li>They are: |;
	$replace_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out_${_}_diseases" ><b><u>$_</u></b></a>\n|  for (@effective_term);
	$replace_message.=qq|</li>|;
	$replace_message.=qq|<hr><li>The whole report could be found |;
	$replace_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.predicted_gene_scores" ><b><u>Here</u></b></a>.\n|;
	$replace_message.=qq|<li>The normalized gene scores could be found |;
	$replace_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.final_gene_list" ><b><u>Here</u></b></a>.\n|;
	$replace_message.=qq|<hr><li>The report without prediction could be found |;
	$replace_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.merge_gene_scores" ><b><u>Here</u></b></a>.\n|;
 	$replace_message.=qq|<li>The normalized gene scores without prediction could be found |;
	$replace_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.seed_gene_list" ><b><u>Here</u></b></a>.\n|;
	
	}
	}
	else
	{
	$replace_message.="<li>All the possible diseases in the gene_disease database will be considered.</li>\n";	
	}
	if(-s "out.annotated_gene_scores" and $effective_term_num)
	{
	       $replace_message.=qq|<hr><li>The report with gene or region selection could be found |;
	       $replace_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.annotated_gene_scores" ><b><u>Here</u></b></a>.\n|;
	       $replace_message.=qq|<li>The normalized gene scores with gene or region selection could be found |;
	       $replace_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.annotated_gene_list" ><b><u>Here</u></b></a>.\n|;
    }
    if(-s "out.variant_prioritization")
    {
    	$replace_message.=qq|<hr><li>The prioritized CNVs could be found |;
	    $replace_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.variant_prioritization" ><b><u>Here</u></b></a>.<hr>\n|;	
    }
	if($effective_term_num) { $replace_message.="<li>The top <b>$MAX_COUNT</b> genes are displayed below.\n</li>"; }
	else   {   $replace_message.="<li>So sorry, none of your terms has matched records, why don't you try to breakdown long terms in to short ones?\n</li>";    } 
    $replace_message.="</ul></div>";
    
    
    if($effective_term_num or $info{"all_diseases"} eq "yes")
    {
                                           
	my $i=0;
	my $count=0; 
	my $gene=();
	my @all_gene=();                      #Save the gene names 
	my %links = (
	        "ORPHANET" => 'http://www.orpha.net/consor/cgi-bin/OC_Exp.php?Lng=EN&Expert=',
	        "OMIM"     => "http://www.omim.org/entry/",
	        "CLINVAR"     => "http://www.omim.org/entry/",
	        "GENE_REVIEWS" => "http://www.ncbi.nlm.nih.gov/books/",
	        "HPRD"   => "http://www.ncbi.nlm.nih.gov/pubmed/",
	        "HTRI"   => "http://www.ncbi.nlm.nih.gov/pubmed/",
	        "GWAS"   => "http://www.ncbi.nlm.nih.gov/pubmed/",
	        "BIOSYSTEM"=> "https://www.ncbi.nlm.nih.gov/biosystems/" ,
	        "GENE_FAMILY" => "http://www.genenames.org/genefamilies/"
	        
	);
	
	for my $line(<RES>){                  #print each result               
		if($i==0){$i++;next;}
		$i++;
		if($i==2){
			$replace_message.=qq|<h2 class="result">Prioritized gene list</h2>\n|;
			$replace_message.=qq|<div id="accordion">\n|;
        }
		if($line=~/^\s*$/){
			if($gene) {$replace_message.=qq|</div>\n|;}
			$gene="";next;
		}
		chomp($line);
		if(not $gene){
			$count++;
			last if ($count > $MAX_COUNT);
			$line=~/^(.*?)\tID:(\d*).*?(Reported|Predicted)\s*(.*?)$/;
			$gene=$1;
			my @genes = split(",", $gene);
			$gene = $genes[0];
			my ($id, $status, $score) = ($2, $3, $4);
			push @all_gene,$gene;
			$line=~s/ID:\d* - //;
			
			$score = sprintf("%.4g",$score);
			$line= qq|<h3 id="$count" class="gene_score $status"><p>|.$gene."</p><p>$status</p><p>Score:$score</p></h3>\n";
			$replace_message.=$line.qq|<div><p><span><a class = "outside $status" href="http://www.ncbi.nlm.nih.gov/gene/$id">$gene</a></span></p>|;
		}
	    else{
	    	my ($source, $evidence, $term, $individual_score) = split ("\t", $line);
            $individual_score = sprintf("%.4g",$individual_score);
            my ($source_out, @id_out);
	    	if ($source =~ /^(\w+):(.*?) \((\w+)\)$/)
	    	{
	    	my ($id_name, $id_string, $database) = ($1, $2, $3);
	    	my @ids = split(" ", $id_string);
	    	
	    	for my $each_id(@ids)
	    	{
	    		my $new_id=$each_id;
	    		   $new_id = $omim_to_gene_review{$each_id} if ($database eq "GENE_REVIEWS");
           		my $id_link = qq|<a class="outside" href="$links{$database}$new_id" >$each_id</a>|;
           		push @id_out ,$id_link;
          	}
	    	$source_out = join(" ", @id_out);
	    	$source_out = $id_name.":".$source_out." ($database)";
	    	
	    	}
	    	if ($source =~ /\b(BIOSYSTEM)|(HPRD)|(GENE_FAMILY)|(HTRI)\b/)
	     	    { 	
	     	    $line = join('</span><span>',($source_out, $evidence, $term." ($individual_score)") ); 
	     	    $line = qq|<p class="$count related_interaction"><span>|.$line."</span></p>\n";
	     	    } 
	    	else{$line = join('</span><span>',($source_out, $evidence, $term." ($individual_score)") ); 
	    		
	    		$line=qq|<p class="$count related_disease"><span>|.$line."</span></p>\n";
	    	    }
	        if($source =~ /^Not available/) { 
	        	$line = join('</span><span>',($source, $evidence, $term." ($individual_score)") ); 
	        	$line = qq|<p class="$count related_disease"><span>|.$line."</span></p>\n"; }    
	    	$replace_message.=$line;
	    	}
	                 }
	$replace_message.="</div>\n"  if($i!=2);
    }
    
    
    $replace_message.=qq|
                
                 <script type="text/javascript"  src="$WEBSITE/js/cytoscape.min.js" ></script>
                 <script type="text/javascript"  src="$WEBSITE/js/arbor.js" ></script> 
                 <script src="$WEBSITE/js/jquery.cytoscape.js-panzoom.js"></script>
                 <script type="text/javascript"  src="$WEBSITE/result_control.js" ></script>
                 
                 |;
   
	#-----------------------------------------print out the website------------------------------------
	my $network = qq|<div id="cy"></div>
	  <h3 id="barplot"  ><a class="outside" href="barplot.html" >Click me to see the Bar Plot</a></h3>
			<label class="result" >Options:  </label>
		<div id="network_control">
  <input type="checkbox" id="gene_off"><label for="gene_off">Gene Off</label>
  <input type="checkbox" id="disease_off"><label for="disease_off">Disease Off</label>
  <input type="checkbox" checked id="show_gene_names"><label for="show_gene_names">GeneNames</label>
  <input type="checkbox" id="show_disease_names"><label for="show_disease_names">DiseaseNames</label>
        </div>
        <input type="button" id="save_photo" value="Save Photo">
        <input type="button" id="tooltips"    value="Tool Tips">
         <label class="result" for="show_edges" >Edges:  </label> 
       <select id="show_edges" name="show_edges">
       <option selected value="all">All</option>
       <option value="HPRD">Protein Interaction</option>
       <option value="Biosystem">In the same Biosystem</option>
       <option value="GeneFamily">In the same Gene Family</option>
       <option value="TranscriptionInteraction">Transcription Interaction</option>
       </select>
       <label class="result" for="adjust_layout" >Layout:  </label> 
       <select id="adjust_layout" name="adjust_layout">
       <option selected value="force">Force</option>
       <option value="circle">Circle</option>
       <option value="grid">Grid</option>
       <option value="concentric">Concentric</option>
       </select>|;
	
	if($effective_term_num)
	{$result_page=~s/%%%%Network%%%%/$network/; }
	else{
	  	$result_page=~s/%%%%Network%%%%//;
	}
	$result_page=~s/%%%%Content%%%%/$replace_message/;
	
	
	print HTML $result_page;
	close (RES);
	close (HTML);
	
	$email_header = "Dear Phenolyzer user, your submission (identifier: $id) was received at $info{submission_time} and processed at $process_time.\n";
	$email_header =~ s/(.{1,69})\s/$1\n/g;

	if ($failed_command) {
		$email_body = "We were unable to generate results for your submission due to an '$failed_command' error.\n";
	} else {
		$email_body = "Your submission is done: $WEBSITE/done/$id/$password/index.html\n\n";#### url
		
		$email_body .= "bedfile=$info{bedfile}\nbuildver=$info{buildver}\n\n" if defined $info{bedfile};
		
		$email_tail .= "The citation for the above result is: $WEBSITE\n\n";
		$email_tail .= "Questions or comments may be directed to $CARETAKER.\n";
		$email_tail =~ s/(.{1,69})\s/$1\n/g;
	}
		
	open (EMAIL, ">email") or (warn ">" . scalar (localtime) . " (id: $id)\ncannot create new mail $ARGV[1]\n" and return);
	flock (EMAIL, 2);
	print EMAIL "From: $CARETAKER\nReply-To: $CARETAKER\nSubject: Phenolyzer web server results for your query (identifier: $id)\n\n";
	print EMAIL $email_header, '-'x70, "\n\n", $email_body, '-'x70, "\n\n", $email_tail, "\n";
	flock (EMAIL, 8);
	close (EMAIL);

	if ($info{email}) {
		system ("/usr/sbin/sendmail $info{email} < $WORK_DIRECTORY/$id/email") and warn '>' . scalar(localtime) . " (id: $id)\ncannot send mail\n" and return 0;
	}
	
	#system("cp index.html $HTML_DIRECTORY/done/$id/$password") and warn "Error runnning <cp index.html $HTML_DIRECTORY/done/$id/$password>";
	system("mv index.html $HTML_DIRECTORY/done/$id/$password/") and die;
	system("mv network.json $HTML_DIRECTORY/done/$id/$password/") and print STDERR "Can't find network.json!!\n";
	system("mv out* $HTML_DIRECTORY/done/$id/$password/") and die;
	system("mv $WORK_DIRECTORY/$id/* $HTML_DIRECTORY/done/$id/");
	system("cp $HTML_DIRECTORY/barplot.html $HTML_DIRECTORY/done/$id/$password/") and die;
	rmdir ("$WORK_DIRECTORY/$id");
	sleep(20);		#artificially increase execution time for debugging purposes
}

sub deleteOldFiles {
	 my @file_list = split("\n",`ls $HTML_DIRECTORY/done`);
	 my $days=60;
	 for my $file (@file_list)
	 {
	 	my $file_days = -M "$HTML_DIRECTORY/done/$file";
	    #print STDERR $file."\t".$file_days."\n";	
	 	if( ($file_days>$days) and (-d "$HTML_DIRECTORY/done/$file"))
	 	{	 	
	    next if($file eq "1807" or $file eq "1879" or $file eq "1885");			
	 	system("rm -rf $HTML_DIRECTORY/done/$file") and warn "WARNING:Can't remove old files in $HTML_DIRECTORY/done/$file \n"  ;
	 	print STDERR "Delete $file succesfully! \n";
	 	}
	 }
}


=head1 SYNOPSIS

 serve_loh.pl [arguments]

 Optional arguments:
        -h, --help                      print help message
        -m, --man                       print complete documentation
        -v, --verbose                   use verbose output
            --id <int>			process this specific submission
            

 Function: function as a LOH server
                   
 Version: $LastChangedDate: 2013-05-21 08:53:41 -0700 (Tue, 21 May 2013) $

=head1 OPTIONS

=over 8

=item B<--help>

print a brief usage message and detailed explanation of options.

=item B<--man>

print the complete manual of the program.

=item B<--verbose>

use verbose output.

=back

=head1 DESCRIPTION

This is the description.


=cut

