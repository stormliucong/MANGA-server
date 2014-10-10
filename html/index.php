<!DOCTYPE html>

<html>
<meta charset="utf-8"> 
	<head>
	<link rel="icon" type="image/x-icon" href="http://phenolyzer.usc.edu/img/phenolyzer_logo.png" />
		<title>Phenolyzer: Phenotype based gene analyzer</title>
        <link href="http://phenolyzer.usc.edu/css/redmond/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" >
	    <link href="http://phenolyzer.usc.edu/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
	    <link href="./bootstrap-3.2.0-dist/css/bootstrap-select.min.css" rel="stylesheet">
	    <link href="http://phenolyzer.usc.edu/css/phenolyzer.css" rel="stylesheet" type="text/css" >
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		        <script data-turbolinks-track="true" src="asset/js/turbolinks.js"></script>
                  <script type="text/javascript"  src="http://phenolyzer.usc.edu/jquery-1.11.0.min.js"></script>
	              <script type="text/javascript"  src="http://phenolyzer.usc.edu/bootstrap-3.2.0-dist/js/bootstrap.min.js" ></script>
	              <script data-turbolinks-track="true" src="./bootstrap-3.2.0-dist/js/bootstrap-select.min.js"></script>
				<script data-turbolinks-track="true" src="asset/js/vendor/jquery.ui.widget.js"></script>
	<script data-turbolinks-track="true" src="asset/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script data-turbolinks-track="true" src="asset/js/jquery.iframe-transport.js"></script>
    <script data-turbolinks-track="true" src="asset/js/jquery.fileupload.js"></script>
	<script data-turbolinks-track="true" src="asset/js/turbolinks.js"></script>
	<script data-turbolinks-track="true" src="js/form_control_1.js"></script>
	</head>
	<body>
	 <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header col-md-3">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://phenolyzer.usc.edu/index.php"><p class="title">Phenolyzer</p></a>
		 
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li class="active" ><a href="http://phenolyzer.usc.edu/index.php">Home</a></li>	
			   	<li><a href="http://phenolyzer.usc.edu/download.php">Download</a></li>
			    <li><a href="http://phenolyzer.usc.edu/tutorial.php">Tutorial</a></li>
			   	<li><a href="http://phenolyzer.usc.edu/FAQ.php">FAQ</a></li>
			   	<li><a href="http://phenolyzer.usc.edu/example.php">Example</a></li>
			   	
			  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Related projects<span class="caret"></span></a>
		    <ul class="dropdown-menu" role="menu">
                   <li><a href="http://wannovar3.usc.edu">wANNOVAR</a></li>
                    <li><a href="http://icages.usc.edu/">iCAGES</a></li>
                    <li><a href="http://enlight.usc.edu/">Enlight</a></li>
                  </ul>
                </li>
          </ul>
		  <div class="navbar-header navbar-right col-md-3" >
		    <a class="title navbar-brand" href="http://genomics.usc.edu"><img src="http://wannovar3.usc.edu/asset/img/logo.png" alt="" style="height:100%;"></a>
		  </div>
        </div><!--/.nav-collapse --> 
	  </div>
    </div>
    
	<div class="jumbotron" id="phenolyzer">
	<div class="container">
	<div class="col-lg-8 col-lg-offset-1" style="">
  <h1>Phenolyzer</h1>
  <p>Phenolyzer stands for Phenotype Based Gene Analyzer, a tool focusing on discovering genes based on user-specific
  disease/phenotype terms. </p> 
  <p><a class="title-button btn btn-danger btn-lg" role="button" href="#getstart">Get Started</a>
  <button class="title-button btn btn-info btn-lg" data-toggle="modal" data-target="#contact-phenolyzer">Contact</button>
  
  <!-- Modal -->
<div class="modal fade" id="contact-phenolyzer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-title text-primary" id="myModalLabel">Contact Phenolyzer</h4>
      </div>
      <div class="modal-body">
	 <h5><strong>Phenolyzer</strong> relies on your feedback. Please send an Email if you wish to make a request, a comment, or report a bug.</h5>	
         <h5>Dr. Kai Wang:<br>
Assistant Professor, Psychiatry and Preventive Medicine; Member, Zilkha Neurogenetic Institute and Norris Comprehensive Cancer Center
        <br>Web Site: <a href="http://genomics.usc.edu/">http://genomics.usc.edu</a>
        <br>Email: <a href="mailto:kaiwang@usc.edu">kaiwang@usc.edu</a> </li>
         <br><br>Hui Yang:<br>
           Graduate Student, Zilkha Neurogenetic Institute, USC Neuroscience Graduate Program        
        <br>Web Site: <a href="http://genomics.usc.edu/">http://genomics.usc.edu</a>
        <br>Email: <a href="mailto:yanghui@usc.edu">yanghui@usc.edu</a> </li></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> <!-- Modal End-->

  </p></div></div></div>
  
		<div class="container">
		<div class="phenolyzer-content col-lg-8 col-lg-offset-1">
   	    <form action="/cgi-bin/loh.cgi" method="post" ENCTYPE="multipart/form-data" role="form" class="form-horizontal" >
     	
     	<h3 id="getstart" class="page-header text-primary">Basic Information</h3>  
		<div class="form-group">
        <label for="email" class="col-md-3 control-label">Email</label>
        <div class="col-md-9">
        <input  type="email" required  class="form-control" id="email" name="email" placeholder="Email">
        </div>
	     </div>
	     
      <div class="form-group">
	  <label title="" class="col-md-3 control-label disease" >Diseases/Phenotypes</label>
	   <div class="col-md-9">
	   <textarea  required title="" class="form-control" name="disease" id="disease" rows="4" placeholder="please enter your focused disease/phenotype terms"></textarea> 
	   <span class="help-block">Please use semicolon or enter as separators. Like "alzheimer;brain".
	    <br> Try to use multiple terms instead of a super long term
	    <br>OMIM IDs are also accepted, like 114480 for 'Breast cancer'</span>
	   </div>
	  </div> 
	  
	   <div class="form-group">
	  <label class="col-md-3 control-label" > </label>
	   <div class="col-md-8">
	  <button type="submit" class="btn btn-info ">
	  <span class="glyphicon glyphicon-send"></span> Submit</button>
      <button type="reset" class="btn btn-success ">
	  <span class="glyphicon glyphicon-repeat"></span> Reset</button>
	   </div></div>    
                 
               <h3 class="page-header text-primary">Options</h3> 
               
              <div class="form-group">
               <label title="" for="gene_selection" class="col-md-3 control-label gene_selection_options">Gene Selection  </label>
               <div class="col-md-5">
                <select class="selectpicker show-menu-arrow " name="gene_selection" id="gene_selection_options">
	           <option selected value="no" >No</option>
                 <option value="yes"  >Yes</option>
	           </select>
                </div>
               <div class="col-md-3">
	   <button type="button" class="btn btn-info btn-sm" data-toggle="popover"
       title="Gene Selection",
       data-content="Turn on the Gene Selection to input your own genelist instead of conducting a genome-wide priotritization? You can use your gene list 
        generated from wANNOVAR! Is that amazing?">
       <span class="glyphicon glyphicon-th-list"></span></button>
	   </div></div>
	   
	     <div class="form-group" id="gene_selection">
                  <label title="" class="col-md-3 control-label" >Enter your genes here</label>
	   <div class="col-md-9">
	   <textarea  title="" class="form-control" name="genelist" id="genelist" rows="4" placeholder="please paste your gene list here."></textarea> 
	   <span class="help-block">Please separate genes by semicolon or enter. Entrez IDs are also accepted here.</span>
            </div> </div> 
            
            <div class="form-group" >
               <label title="" for="region_selection" class="col-md-3 control-label region_selection_options">Region Selection  </label>
               <div class="col-md-5">
                <select class="selectpicker show-menu-arrow " name="region_selection" id="region_selection_options">
	           <option selected value="no" >No</option>
                 <option value="yes"  >Yes</option>
	           </select>
                </div>
                 <div class="col-md-3">
	   <button type="button" class="btn btn-info btn-sm" data-toggle="popover"
       title="Region Selection",
       data-content="Turn on the Region Selection to upload your focusing genomic regions. You can use your bed file called from a CNV calling Pipeline! Is that amazing?">
       <span class="glyphicon glyphicon-th-list"></span></button>
	   </div></div>
         <div id="region_selection">
	   <div class="form-group" >
    <label class="col-md-3 control-label bedfile"> <a id="bed_instruction" href="https://genome.ucsc.edu/FAQ/FAQformat.html#format1" target="_blank">Input Bed File</a></label>

	<div class="col-sm-9">
	       <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                         <span class="glyphicon glyphicon-plus"></span> Bed File
						 <input type="file" name="bedfile" id="bedfile">
                    </span>
                </span>
                <input type="text" class="form-control" readonly>
            </div>
	 </div> </div>
	 
	 	 <div class="form-group">
    <label for="buildver" class="col-md-3 control-label">Reference Genome</label>
    <div class="col-md-5">
      <select class="selectpicker show-menu-arrow   k" name="buildver" id="buildver" style="display: none;">
	           <option selected="" value="hg19">hg19</option>
               <option value="hg18">hg18</option>
	  </select>
	  </div>
	<div class="col-md-3">
	<button type="button" class="btn btn-info btn-sm" data-toggle="popover" title="" ,="" data-content="Neurocomplex currently supports hg18 and hg19 genome build. " data-original-title="Reference Genome">
       <span class="glyphicon glyphicon-th-list"></span></button>
	</div>
    </div>
	 	 </div>    
	
        
            
	         <div class="form-group">
	 <label for="other_options" title="" class="col-md-3 control-label advanced_options">Advanced Options  </label>
	 <div class="col-md-5">
      <select class="selectpicker show-menu-arrow" title = "" name="other_options" id="other_options">
	          <option selected value="phenotype_interpretation" >Phenotype Interpretation</option>
                 <option value="none" >Disease Only</option>
                 <option value="all_diseases" >Select all diseases</option>
	  </select>
    </div>
     <div class="col-md-3">
	   <button type="button" class="btn btn-info btn-sm" data-toggle="popover"
       title="Advanced Options",
       data-content="Phenotype interpretation: Interpret phenotype terms into disease names
		          All diseases: All diseases in the gene disease database are used">
       <span class="glyphicon glyphicon-th-list"></span></button>
	   </div>
       </div> 
       
         <div class="form-group">
               <label title="" for="weight_adjust_options" class="col-md-3 control-label weight_adjust_options">Weight Adjust  </label>
               <div class="col-md-5">
                <select class="selectpicker show-menu-arrow " name="weight_adjust" id="weight_adjust_options">
	           <option selected value="no" >No</option>
                 <option value="yes"  >Yes</option>
	           </select>
                </div>
               <div class="col-md-3">
	   <button type="button" class="btn btn-info btn-sm" data-toggle="popover"
       title="Weight Adjust",
       data-content="You can adjust the weights of each data source. or even turn it off. Is this amazing?">
       <span class="glyphicon glyphicon-th-list"></span></button>
	   </div>
       </div> 
       
                 <div id="weight_adjust" class="col-lg-12">
                 <br><br>
                 <div class="col-md-6">
                 <div class="form-group">  
                 <label " class="col-md-5 control-label">GWAS</label>
                 <div class="col-md-7">
                 <input type="text" class="form-control text-form" id="GWAS" name="GWAS" value="1">
                 </div>   
                 </div>  
                 <div class="form-group">       
                  <label class="col-md-5 control-label">OMIM</label>
                 <div class="col-md-7">
                 <input type="text" class="form-control text-form" id="OMIM" name="OMIM" value="1">
                 </div>
                 </div>
                 <div class="form-group">       
                  <label class="col-md-5 control-label">ClinVar</label>
                 <div class="col-md-7">
                 <input type="text" class="form-control text-form" id="CLINVAR" name="CLINVAR" value="1">
                 </div>
                 </div>
                  <div class="form-group">       
                  <label class="col-md-5 control-label">Orphanet</label>
                 <div class="col-md-7">
                 <input type="text" class="form-control text-form" id="ORPHANET" name="ORPHANET" value="1">
                 </div>
                 </div>
                 <div class="form-group">       
                  <label class="col-md-5 control-label"> Gene Reviews</label>
                 <div class="col-md-7">
                 <input type="text" class="form-control text-form" id="GENE_REVIEWS" name="GENE_REVIEWS" value="1">
                 </div>
                 </div>
                 </div>
                 <div class="col-md-6">
                  <div class="form-group">       
                  <label class="col-md-5 control-label">HPRD</label>
                 <div class="col-md-7">
                 <input type="text" class="form-control text-form" id="HPRD" name="HPRD" value="0.1">
                 </div>
                 </div>
                 <div class="form-group">       
                  <label class="col-md-5 control-label">Biosystem</label>
                 <div class="col-md-7">
                 <input type="text" class="form-control text-form" id="BIOSYSTEM" name="BIOSYSTEM" value="0.05">
                 </div>
                 </div>
                 <div class="form-group">       
                  <label class="col-md-5 control-label">Gene Family</label>
                 <div class="col-md-7">
                 <input type="text" class="form-control text-form" id="HGNC" name="HGNC" value="0.05">
                 </div>
                 </div>
                  <div class="form-group">       
                  <label class="col-md-5 control-label">HTRI</label>
                 <div class="col-md-7">
                 <input type="text" class="form-control text-form" id="HTRI" name="HTRI" value="0.05">
                 </div>
                 </div>
                 
                 </div>
                 </div>
           
                <div class="form-group">
               <label title="" for="wordcloud" class="col-md-3 control-label wordcloud">Word Cloud  </label>
               <div class="col-md-5">
                <select class="selectpicker show-menu-arrow " name="wordcloud" id="wordcloud">
	           <option selected value="no" >No</option>
               <option value="yes"  >Yes</option>
	           </select>
                </div>
                 <div class="col-md-3">
	   <button type="button" class="btn btn-info btn-sm" data-toggle="popover"
       title="Word Clouod",
       data-content="Choose yes if you want to see the Word Cloud of your phenotype/disease. Is this amazing?">
       <span class="glyphicon glyphicon-th-list"></span></button>
	   </div> </div>
	   
	   <!-- Addon -->
	   <div class="form-group">
	 <label for="step" class="col-md-3 control-label">Addon Gene Relations</label>
	 <div class="col-md-7">
      <select class="selectpicker show-tick"  multiple name="addon" id="addon" data-selected-text-format="count>1">
	           <option value="DB_MENTHA_GENE_GENE_INTERACTION">Mentha Protein Interaction Database</option>			  	   
	  </select>
    </div>
	</div>
	<!-- End of Addon -->
	   
	  
                 
                 <input type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" name="ip" />
                 <input type='hidden' value='<?php echo GetHostByAddr($_SERVER['REMOTE_ADDR']); ?>' name='host'>
                    </form> 
          
	 </div>
	  <div class="wannovar-news col-md-3 " id="news">
	   <h3 class="page-header text-primary"> Recent Updates</h3>
	    <div class="panel panel-default">
	    <div class="panel-body">
    		 <p>Now the email is required. Please type in your email. Thanks very much.</p>
    		</div></div>
	   
	   <div class="panel panel-default">
	    <div class="panel-body">
    		<p><strong>[09/19/2014]</strong> <p>Phenolyzer is updated into version 1.0.1!</p>
			<p>The word cloud is available by choosing Wordcloud option.
			<p> For command line tool: </p>
			 <p><code>-wordcloud </code>can be used to generate a wordcloud now.
			<p><code>-addon </code>can be used to add your own gene-disease mapping database, the format should be as
			'GENE	DISEASE	DISEASE_ID	SCORE	SOURCE'</p>
			<p><code>-addon_gg </code>can be used to add your own gene-gene mapping database, the format should be as
			'GENE A GENE B	EVIDENCE SCORE PMID'</p>
			<p><code>-addon_gg_weight  -addon_weight </code> can be used to control the weights.
			</p></a></div></div>
			 <div class="panel panel-default">
           <div class="panel-body">
    		<p><strong>[08/19/2014]</strong> <p>Phenolyzer website remade!</p>
			<p>Please report any bugs if you find any. And please give us feedbacks about your experience of Pehnolyzer!</p></div></div>
	       
	       
	       <div class="panel panel-default">
           <div class="panel-body">
    		<p><strong>[06/11/2014]</strong> <p>Phenolyzer version 1.0.0 is for test!</p>
			<p>Biosystem has been updated to 7172014!<br><br>
			NOTICE: Bioperl is required for the commandline tool!
			Please have a look at  <a href="http://www.bioperl.org/wiki/Installing_BioPerl">Bioperl</a> 
			If you don't have Bioperl in your computer. </p></div></div> 
			
		</div> 
		
		 
		
		</div>  
		<!-- container -->
            <div class="container">
     <div class="footer col-lg-offset-1">
     <p class="text-muted">Rights Reserved @Hui Yang USC Neuroscience</p>
      </div></div>    
                
                 
               
               
                 
                 
             
	</body>
</html>