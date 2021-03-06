#!/usr/bin/env perl
use warnings;
use strict;
use Pod::Usage;
use Getopt::Long;
use GenomicsServer;
use List::Util qw(max);
BEGIN{
push @INC,"/home/huiyang/perl5/lib/perl5";
}
use JSON;

our ($verbose, $help, $man);
our ($id);

GetOptions ('verbose'=>\$verbose, 'help'=>\$help, 'man'=>\$man, 'id=i'=>\$id) or pod2usage ();

$help and pod2usage (-verbose=>1, -exitval=>1, -output=>\*STDOUT);
$man and pod2usage (-verbose=>2, -exitval=>1, -output=>\*STDOUT);
@ARGV and pod2usage (-verbose=>0, -exitval=>1, -output=>\*STDOUT);

GenomicsServer::setupVariable ('stormliucong@gmail.com', '/Users/congliu/Sites/phenolyzer-server','http://localhost');
#deleteOldFiles();
if (defined $id) {
	processSubmission ($id);	#process a specific submission and then quit
} else {
	my $subroutine = \&processSubmission;
	
	GenomicsServer::parallelProcessSubmission ($subroutine, 30, 5, 100);	#max simultaneous jobs=5, check status every 5 seconds, exit after 100 seconds
	

}

sub processSubmission {
        my ($id) = @_;
        my %info;
	my ($system_command);
	my ($failed_command);
	my $result_page ="";
	my $submission_message = "";
	my $summary_message ="";
	my $network_message ="";
	
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
        my $software_name;
        $software_name="Phenolyzer";
        my $template_file;
        $template_file="template_new.html";
        my $process_time = scalar (localtime);
        my ($email_header, $email_body, $email_tail);
	my $password = $info{"password"};
	
	$system_command = "perl $BIN_DIRECTORY/disease_annotation.pl -d $LIB_DIRECTORY/compiled_database -out out -prediction -w $BIN_DIRECTORY ";
	$system_command.="-f ";
	$system_command.="-wordcloud " if($info{"wordcloud"});
	
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
    ##############################  Dr. Coba   ################################
    elsif($info{"coba"}){
    	$template_file="template_new_coba.html";
    	$software_name="Neurocomplex";
		$system_command.="-addon DB_COBA_NEUROCOMPLEX " ;
		$system_command.="-addon_gg DB_MENTHA_GENE_GENE_INTERACTION ";
		$system_command.="-addon_gg_weight 0.05 ";
		$system_command.="-hprd_weight         0 ";
        $system_command.="-biosystem_weight    0 ";             
        $system_command.="-gene_family_weight  0 ";           
        $system_command.="-htri_weight         0 ";
	}
	##############################  Dr. Coba  End################################
    else{
	    $system_command.="-logistic ";
    }
	if($info{'addon_gg'}){$system_command.="-addon_gg $info{'addon_gg'} -addon_gg_weight 0.05 ";}
	if($info{'addon_seed'}) {$system_command.="-addon $info{'addon_seed'} -addon_weight 0.25 ";}
	if($info{"disease_file"}){$system_command.="$info{disease_file} ";}
	if($info{"phenotype_interpretation"} eq "yes"){$system_command.="-phenotype ";}
	if(defined $info{"haploinsufficiency"} and $info{"haploinsufficiency"} eq "yes"){ $system_command.="-hi "; }
	if(defined $info{"intolerance"} and $info{"intolerance"} eq "yes"){ $system_command.="-it "; }
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
			my @scores = map {$gene_hash{$_} or 0;  } @genes; 
			my $key = join("\t",@words[2..4,1]);
			$variant_out{$key} = max(@scores);
		 
		}
		close(VARIANT);
		print VARIANT_OUT $_."\t".$variant_out{$_}."\n"  for (sort {$variant_out{$b} <=> $variant_out{$a};} keys %variant_out);
		
	}
		
	open (HTML, ">index.html") or die "can't write out index.html: $!";
	open (TEMPLATE, "$HTML_DIRECTORY/$template_file") or die "$HTML_DIRECTORY/$template_file does not exist!";
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
	my $MAX_COUNT = 2000;
	my $MAX_ITEM = 20000;
	$result_page.=$_  for(<TEMPLATE>);
	
	#-------------------------------Submission Message-----------------------------
    
	$submission_message = qq|<h4 class="page-header"> 
	   Submission ID: $id</h4>
	  <p class="result">Dear $software_name user, your submission was received at $info{submission_time} and processed at |.scalar(localtime).qq|.</p>|;
	$result_page =~ s/%%%%submission%%%%/$submission_message/;
	#-------------------------------Summary Message-----------------------------
	$summary_message.=	qq|<li class="list-group-item">Bedfile is $info{bedfile}.</li>| if $info{bedfile};
    $summary_message.=	qq|<li class="list-group-item">Buildver is $info{buildver}.</li>| if $info{bedfile};
	$summary_message.=	qq|<li class="list-group-item">All diseases are considered.</li>| if($info{all_diseases} eq "yes");
	$summary_message.=	qq|<li class="list-group-item">Phenotypes are interpretated.</li>| if($info{phenotype_interpretation} eq "yes");
	my $out_gene_num = 0;
	if(-s "gene_list.txt"){
		my $gene_num=`wc -l gene_list.txt`;
		$gene_num=~/(\d+)/;
		$gene_num = $1;
		$summary_message.=	qq|<li class="list-group-item"><b>$gene_num</b> genes are entered within the genelist.</li>|;
		
	}
	if(-s "out.annotated_gene_list")
    {
        $out_gene_num = `wc -l out.annotated_gene_list`;
        $out_gene_num=~ /(\d+)/;
        $out_gene_num= $1;
        $summary_message.=	qq|<li class="list-group-item">No gene within the genelist or the region was found.</li>|		
		if( $out_gene_num<=1);
        $out_gene_num--;
    }
    $summary_message.=	qq|<li class="list-group-item">At most <b>$MAX_COUNT</b> genes will be found in details, for the complete list, please download the report here.</li>| if($effective_term_num);
	if($info{"all_diseases"} ne "yes")
	{
	$summary_message.=qq|<li class="list-group-item">$info{legal_disease_num} disease terms have been entered, among which, $effective_term_num terms have corresponding records in our database.</li>\n|;
	$summary_message.=qq|<li class="list-group-item">They are: | if($effective_term_num);
	for (@effective_term){
	$summary_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out_${_}_diseases" ><b>$_</b></a>  \n|;
	$summary_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out_${_}_hpo" ><b>(HPO)</b></a>  \n| if (-s "out_${_}_hpo");
	$summary_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out_${_}_wordcloud.png" ><span class="label label-info"><b>WordCloud</b></span></a>| if($info{"wordcloud"})  ;
	}
	$summary_message.=qq|</li>|;
	}
	else
	{
	$summary_message.=qq|<li class="list-group-item">All the possible diseases in the gene_disease database will be considered.</li>\n|;	
	}
	if(-s 'out.annotated_gene_scores'  )
	{
		   my $out_num = $out_gene_num;
	       $summary_message.=qq|<li class="list-group-item">The <b class="text-info">GENELIST/REGION SPECIFIC REPORT</b> could be found |;
	       $summary_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.annotated_gene_scores" ><b><u>Here</u>($out_num genes)</b></a>.\n|;
	       $summary_message.=qq|<li class="list-group-item">The <b class="text-info">GENELIST/REGION SPECIFIC GENE LIST</b> could be found |;
	       $summary_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.annotated_gene_list" ><b><u>Here</u>($out_num genes)</b></a>.\n|;
    }
    else{
    	$summary_message.=qq|<li class="list-group-item">Sorry, there is no available result. |  
    	if($info{"gene_file"} or $info{"bedfile"}) ; 
    	
    }
    if(-s "out.variant_prioritization")
    {
    	$summary_message.=qq|<li class="list-group-item">The prioritized <b class="text-info">CNVs</b> could be found |;
	    $summary_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.variant_prioritization" ><b><u>Here</u></b></a>\n|;	
    }
	
	if($effective_term_num)
	{
	my $out_num = `wc -l out.final_gene_list`;	
	$out_num =~ /(\d+)/;
	$out_num = $1;
	$out_num--;
	$summary_message.=qq|<li class="list-group-item">The <b class="text-info">WHOLE REPORT</b> could be found |;
	$summary_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.predicted_gene_scores" ><b><u>Here</u>($out_num genes)</b></a>.</li>\n|;
	$summary_message.=qq|<li class="list-group-item">The <b class="text-info">FINAL GENE LIST</b> could be found |;
	$summary_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.final_gene_list" ><b><u>Here</u>($out_num genes)</b></a>.</li>\n|;
	$out_num = `wc -l out.seed_gene_list`;
	$out_num =~ /(\d+)/;
    $out_num = $1;
	$out_num--;
	$summary_message.=qq|<li class="list-group-item">The <b class="text-info">SEED GENE REPORT</b> could be found |;
	$summary_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.merge_gene_scores" ><b><u>Here</u>($out_num genes)</b></a>.</li>\n|;
 	$summary_message.=qq|<li class="list-group-item">The <b class="text-info">SEED GENE LIST</b> could be found |;
	$summary_message.=qq|<a class = "outside" href = "$WEBSITE/done/$id/$password/out.seed_gene_list" ><b><u>Here</u>($out_num genes)</b></a>.</li>\n|;
	
	}
	
	if(not ( ($effective_term_num and not -s 'out.annotated_gene_scores') or  (-s 'out.annotated_gene_scores' and $out_gene_num >= 1 )  ) ) 
	  {   $submission_message.="<P>So sorry, none of your terms has matched records, why don't you try to breakdown long terms in to short ones?\n</p>";    } 
   
    
    #-------------------------------Print Details-----------------------------
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
	        "GENE_FAMILY" => "http://www.genenames.org/genefamilies/",
	        "ADDON_GENE_GENE" => "http://www.ncbi.nlm.nih.gov/pubmed/"
	        
	);
my %gene_html = ();	
my @output;
my $rank=1;
	for my $line(<RES>){                  #print each result               
		if($i==0){$i++;next;}
		$i++;
		
		if($line=~/^\s*$/){
			if($gene) {$gene_html{$gene}.=qq|</div>|; 
		    if($info{"coba"})		
		          		{
		          			my @array;
		          			push (@array,$&) while($gene_html{$gene} =~/Dr.Coba's data/g);
		          			my $num =@array+0;
		          			if($num>0)
		          			{
		          			$gene_html{$gene}=~s/<p>$rank $gene/<p>$rank $gene (in $num Dr.Coba's Complexes)/;
		          			}          		
		          		}	
		     push (@output, [$gene,$gene_html{$gene}]);     					
			}
			$gene="";$rank++;last if($i>$MAX_ITEM );next;
			
		}
		chomp($line);
		if(not $gene){
			$count++;
			last if ($count > $MAX_COUNT);
			$line=~/^(.*?)\tID:(\d*).*?(SeedGene|Predicted)\s*(.*?)\s*Normalized score:.*?$/;
			$gene=$1;
			my @genes = split(",", $gene);
			$gene = $genes[0];
			my ($id, $status, $score) = ($2, $3, $4);
			push @all_gene,$gene;
			$line=~s/ID:\d* - //;
			my $status_out = $status;
			$status = "Reported" if ($status eq "SeedGene");
			$score = sprintf("%.4g",$score);
			$line= qq|<h3 id="$count" class="gene_score $status"><p>|.$rank." ".$gene."</p><p>$status_out</p><p>Raw Score:$score</p></h3>";
			$gene_html{$gene}.=$line.qq|<div><p><span><a class = "outside $status" href="http://www.ncbi.nlm.nih.gov/gene/$id">$gene</a></span></p>|;
		}
	    else
	    {
	    	my ($source, $evidence, $term, $individual_score) = split ("\t", $line);
            $individual_score = sprintf("%.4g",$individual_score);
            my ($source_out, @id_out);
            my ($id_name, $id_string, $database);
	    	if ($source =~ /^(\w+):(.*?) \((\w+)\)$/)
	    	{
	    	($id_name, $id_string, $database) = ($1, $2, $3);
	    	$database ||="";
	    	my @ids = split(" ", $id_string);
	    	
	    	for my $each_id(@ids)
	    	{
	    		my $new_id=$each_id;
	    		   $new_id = $omim_to_gene_review{$each_id} if ($database eq "GENE_REVIEWS");
           		my $id_link;
           		if($links{$database})
           		{
           		$id_link = qq|<a class="outside" href="$links{$database}$new_id" >$each_id</a>|;
           		}
           		else 
           		{
           			$id_link=$each_id;
           		}
           		push @id_out ,$id_link;
          	}
	    	$source_out = join(" ", @id_out);
	    	$source_out = $id_name.":".$source_out." ($database)";    	
	    	}
	    	else {
	    	$source_out = $source if(not $database or not $links{$database} or $source =~ /^Not available/);
	    	}
	    	if ($source =~ /\b(BIOSYSTEM)|(HPRD)|(GENE_FAMILY)|(HTRI)|(ADDON_GENE_GENE)\b/)
	     	    { 	
	     	    $line = join('</span><span>',($source_out, $evidence, $term." ($individual_score)") ); 
	     	    $line = qq|<p class="$count related_interaction"><span>|.$line."</span></p>";
	     	    } 
	    	else{
	    		 $line = join('</span><span>',($source_out, $evidence, $term." ($individual_score)") ); 
   	    		 $line=qq|<p class="$count related_disease"><span>|.$line."</span></p>";
	    	    }
	    	$gene_html{$gene}.=$line;
	    	
	    	 }
        }
       
	my $json_text = to_json(\@output);
	    	open (OUTPUT, ">details.json") or die;
	    	print OUTPUT $json_text; 
    }
   
	#-----------------------------------------print out the website------------------------------------
	$network_message = qq|<div id="cy"></div>
     	<br>
     	
		<div id="network_control" class="panel panel-primary">
	
		 <label class="text-primary" for="disease_on">Disease</label>
		 <input checked type="checkbox" id="disease_on" >
        <label class="text-primary" for="gene_on">Gene</label>
        <input  checked type="checkbox" id="gene_on">
        <label class="text-primary"  for="show_gene_names">Gene Name</label>
        <input type="checkbox" checked id="show_gene_names">
        <label class="text-primary"  for="show_disease_names">Disease Name</label>
        <input type="checkbox"  id="show_disease_names">
        </div>
        <div class="panel panel-primary" id="network_control_2">
        <div class="form-group">
        <div class="col-lg-4">
      <button type="button" class="btn btn-default btn-success" id="save_photo">
      <span class="glyphicon glyphicon-picture"></span>  Save Photo</button>
         <button type="button" class="btn btn-primary" id="tooltips" >
         <span class="glyphicon glyphicon-list"></span> Tooltips</button>
         </div>
       <label class="col-lg-2 result control-labe text-primary" for="show_edges" >Interactions:</label> 
         <div class="col-lg-3">
       <select id="show_edges"  class="selectpicker show-menu-arrow" name="show_edges">
       
       <option selected value="all">All</option>
       <option value="HPRD">Protein Interaction</option>
       <option value="Biosystem">In the same Biosystem</option>
       <option value="GeneFamily">In the same Gene Family</option>
       <option value="TranscriptionInteraction">Transcription Interaction</option>
       </select>
       </div>
       
       <label class="col-lg-1 result control-label text-primary" for="adjust_layout" >Layout:  </label> 
        <div class="col-lg-2">
       <select id="adjust_layout" name="adjust_layout"  class="selectpicker show-menu-arrow">
       <option value="force">Force</option>
       <option value="circle">Circle</option>
       <option selected value="grid">Grid</option>
       <option value="concentric">Concentric</option>
       </select>
       </div>
       </div>
     </div>|;
	
	if($effective_term_num )
	{$result_page=~s/%%%%network%%%%/$network_message/; }
	else{
	  	$result_page=~s/%%%%network%%%%//;
	}
	$result_page=~s/%%%%submission%%%%/$submission_message/;
	$result_page=~s/%%%%summary%%%%/$summary_message/;
	
	print HTML $result_page;
	close (RES);
	close (HTML);
	
	$email_header = "Dear $software_name user, your submission (identifier: $id) was received at $info{submission_time} and processed at $process_time.\n";
	$email_header =~ s/(.{1,69})\s/$1\n/g;

	if ($failed_command) {
		$email_body = "We were unable to generate results for your submission due to an '$failed_command' error.\n";
	} else {
		$email_body = "Your submission is done: $WEBSITE/done/$id/$password/index.html\n\n";#### url
		$email_body .= "Your input terms are: ";
		$email_body .= $_."\n" for (@effective_term);
		
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
		system ("/usr/sbin/sendmail $info{email} < $WORK_DIRECTORY/$id/email") and warn '>' . scalar(localtime) . " (id: $id)\ncannot send mail\n" ;
	}
	
	#system("cp index.html $HTML_DIRECTORY/done/$id/$password") and warn "Error runnning <cp index.html $HTML_DIRECTORY/done/$id/$password>";
	system("mv index.html $HTML_DIRECTORY/done/$id/$password/") and die;
	system("echo '   ' > $HTML_DIRECTORY/done/$id/index.html") and die;
	system("mv network.json $HTML_DIRECTORY/done/$id/$password/") and print STDERR "Can't find network.json!!\n";
	system("mv details.json $HTML_DIRECTORY/done/$id/$password/") and print STDERR "Can't find details.json!!\n";
	system("mv out* $HTML_DIRECTORY/done/$id/$password/") and die;
	system("mv $WORK_DIRECTORY/$id/* $HTML_DIRECTORY/done/$id/");
	
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
	    next if($file eq "2007" or $file eq "2263" or $file eq "2013" or $file eq "2369");			
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

