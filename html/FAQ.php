<!DOCTYPE html>

<html>
<meta charset="utf-8"> 
	<head>
	<link rel="icon" type="image/x-icon" href="/img/phenolyzer_logo.png" />
		<title>Phenolyzer: Phenotype based gene analyzer</title>
        <link href="/css/redmond/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" >
	    <link href="/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
	    <link href="/bootstrap-3.2.0-dist/css/bootstrap-select.min.css" rel="stylesheet">
	    <link href="/css/phenolyzer.css" rel="stylesheet" type="text/css" >
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		        <script data-turbolinks-track="true" src="asset/js/turbolinks.js"></script>
                  <script type="text/javascript"  src="/jquery-1.11.0.min.js"></script>
	              <script type="text/javascript"  src="/bootstrap-3.2.0-dist/js/bootstrap.min.js" ></script>
	              <script data-turbolinks-track="true" src="/bootstrap-3.2.0-dist/js/bootstrap-select.min.js"></script>
				<script data-turbolinks-track="true" src="asset/js/vendor/jquery.ui.widget.js"></script>
	<script data-turbolinks-track="true" src="asset/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script data-turbolinks-track="true" src="asset/js/jquery.iframe-transport.js"></script>
    <script data-turbolinks-track="true" src="asset/js/jquery.fileupload.js"></script>
	<script data-turbolinks-track="true" src="asset/js/turbolinks.js"></script>
	</head>
	<body>
	 <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header col-md-2">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		
             <a class="navbar-brand" style="padding:3px" href="/">
           <img src="./img/phenolyzer.png" style="height:100%"></a>
 
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li><a href="/">Home</a></li>	
			   	<li><a href="/download.php">Download</a></li>
			   	<li><a href="/tutorial.php">Tutorial</a></li>
			   	<li class="active" ><a href="/FAQ.php">FAQ</a></li>
			   	<li><a href="/example.php">Example</a></li>
			   	<li><a href="/cgi-bin/phenohub.cgi">Phenohub</a></li>
			   	
			  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Related projects<span class="caret"></span></a>
		    <ul class="dropdown-menu" role="menu">
             <li><a href="http://wannovar.wglab.org">wANNOVAR</a></li>
                    <li><a href="http://icages.wglab.org/">iCAGES</a></li>
                    <li><a href="http://enlight.wglab.org/">Enlight</a></li>
                    <li><a href="http://seqmule.wglab.org/">SeqMule</a></li>
                  </ul>
                </li>
          </ul>
		  <div class="navbar-header navbar-right col-md-3" >
                    <a class="title navbar-brand" href="http://wglab.org" style="padding:5px"><img src="/img/WGL_long.png" alt="" style="height:100%;"></a>
		  </div>
        </div><!--/.nav-collapse --> 
	  </div>
    </div>
    
	<div class="jumbotron" id="phenolyzer">
	<div class="container">
	<div class="col-lg-10 col-lg-offset-1" >
  <h1>Frequently Asked Questions</h1>
  <p>Want to learn more about Phenolyzer? This is the right place! This section will go over with you about some common questions!</p> 

  </p></div></div></div>
  
		<div class="container faq">
		<div class="panel-group col-lg-10 col-lg-offset-1" id="accordion">

  <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
         1) What does Phenolyzer do?
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
     <p>Phenolyzer takes as input a discrete list of phenotype terms and generates a list of 
			candidate genes weighted by the chance of being associated with the phenotype, even in the absence of any genotype data.</p>
		
        </div>
    </div>
  </div>
  
  <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-1">
      2) How does Phenolyzer perform?
        </a>
      </h4>
    </div>
    <div id="collapse-1" class="panel-collapse collapse">
      <div class="panel-body"><p>
      Below is the comparison between Phenolyzer and other gene/phevor prioritization tools, including Phevor, PosMed, SNP3d, Genecards.
      Phenolyzer works the best to have the best ROC to find COSMIC cancer genes. 
      <br><br>
      <img src="./img/roc_cancer.png" width=450 height=250 />
    
      <img src="./img/auc_cancer.png" width=350 height=250 />
      <br><br>
      Also, for 14 classic monogenic disease genes, Phenolyzer ranked all of them as TOP1, the best among all these tools.
      <br>
       <img src="./img/single_gene_frequency.png" width=470 height=400 />
      </p>
      
      </div></div></div>
      
  <div class="panel panel-warning">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
         3) How does Phenolyzer work?
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
     <p>First, Phenolyzer interprets your term into a set of professional disease names;
			<br>Second, Phenolyzer finds all the genes having a reported association with all the diseases;
			<br>Thirdly, Phenolyzer grows the genes into gene-gene relation databases and get more genes;
			<br>Finally, Phenolyzer integrates all the infomation together and give gene scores.
			<br><br> <img src="images/Phenolyzer_workflow.png" alt="workflow" width="700" /></p>
         </div>
    </div>
  </div>
  
  <div class="panel panel-warning">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-4">
         4) What terms does Phenolyzer accept?
        </a>
      </h4>
    </div>
    <div id="collapse-4" class="panel-collapse collapse">
      <div class="panel-body">
    <p>1) Disease terms, separate by semicolon or return. 
			      For example, 'Alzheimer disease'
	<br>  2)  Phenotype terms, if Phenotype interpretation is selected in advanced options.
			      For example, 'headache; fatigue'
         </div>
    </div>
  </div>
  
    <div class="panel panel-success">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-5">
        5) What should I do if I don't know a specific disease/phenotype right now?
        </a>
      </h4>
    </div>
    <div id="collapse-5" class="panel-collapse collapse">
      <div class="panel-body">
    <p>Choose 'All Diseases' in Advanced Option </p>
         </div>
    </div>
  </div>
  
   <div class="panel panel-success">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-6">
       6) What other inputs do Phenolyzer accept?
        </a>
      </h4>
    </div>
    <div id="collapse-6" class="panel-collapse collapse">
      <div class="panel-body">
    <p>1) A gene list, (Entrez Genes or IDs, lower case is accepted). <a href="/download/genelist.txt"><span class="label label-success">Example</span></a>
			<br>
           2) A region file, in '.bed' format. <a href="/download/cnv.bed"><span class="label label-success">Example</span></a></p>
         </div>
    </div>
  </div>
  
    <div class="panel panel-danger">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-7">
       7) What if Phenolyzer doesn't have records for my term?
        </a>
      </h4>
    </div>
    <div id="collapse-7" class="panel-collapse collapse">
      <div class="panel-body">
    <p>Phenolyzer needs to match your term in its database. If a term is not found, useually it is because your term
			is too long. Please try to break your long term into several short terms.</p>
         </div>
    </div>
  </div>
  
    <div class="panel panel-danger">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-8">
      8) What types of databases do Phenolyzer use?
        </a>
      </h4>
    </div>
    <div id="collapse-8" class="panel-collapse collapse">
      <div class="panel-body">
    <p>1) Disease Databases: CTD's Medic disease vocabulay, Disease Ontology, OMIM's disease synonyms
			<br>2) Gene-Disease Databass: OMIM (Online Mendelian In Man), NCBI's ClinVar, GeneReviews, Orphanet, GWAS Catalog
         	<br>3) Gene-Gene Relation Databases: HPRD (Human Protein Relation Database), NCBI's Biosystem, HGNC Gene Family, HTRI(Human Transcription Interaction)</p>
         </div>
    </div>
  </div>
  
      <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-9">
      9) What are in the output?
        </a>
      </h4>
    </div>
    <div id="collapse-9" class="panel-collapse collapse">
      <div class="panel-body">
    <p>  Please see the <a href="/tutorial.php#ResultPage" target="_blank">turorial</a> page.
	</p>		</div>
    </div>
  </div>
  
    <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-10">
      10) How could I understand the network?
        </a>
      </h4>
    </div>
    <div id="collapse-10" class="panel-collapse collapse">
      <div class="panel-body">
      <p>The network includes the top50 prioritized genes, and their associated diseases and relations with seed genes.
			<br><br>
			<img src="images/network_instruction.png" alt="network_instruction" width="700"/>
			<br><br>
			
			<b>Round Nodes:</b> Genes, blue as reported, and yellow as predicted. The bigger, the higher the score. 
			            The darker, the higher the score. 
			            
		    <br><br><b>Round-rectangles:</b> Diseases, the longer and darker, the larger the contribution the disease.
		    <br><br><b>Big Words:</b> The input terms.
		    <br><br><b>Blue edges:</b> The Protein-protein interaction between two genes, based on the HPRD record.
		    <br><br><b>Yellow edges:</b> The In-the-same-Biosystem relation between two genes, based on NCBI's Biosystem record.
		    <br><br><b>Green edges:</b> The In-the-same-Gene-Family relation between two genes, based on HGNC's Gene Family database.
		    <br><br><b>Black edges with Arrows:</b> The transcription interaction between two genes, the direction of the arrow is from the transcription factor to the target.	
     </div>
    </div>
  </div>
  
   <div class="panel panel-warning">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-11">
       11) How could I play with the network?
        </a>
      </h4>
    </div>
    <div id="collapse-11" class="panel-collapse collapse">
      <div class="panel-body"><p>
       The network is fully interactive, which means it is dynamic. </p>
       <p>A simple trial is to double click an element, like clicking a gene. Then only the elements interacting with this gene will be shown.
       <br>
       Additionally, there are a set of swicthes and controllers below. The gene and disease elements could be turned on and off, also the names of genes and 
       diseases could be turned on and off. By default, the disease names are not shown as they are sometimes super long :).
       <br>
       Also, the different types of interactions could be slelectively shown by choosing one in the 'Edges' selection. The Layout is basically how the network
       is shaped, by default it is force-driven, but by changing <b>Layout</b> one can make it more organized, like 'circle' layout:)
       <br>
       By the way, why not just save a photo of your network and show it to your friends? Just click the Save Photo button:)
      </p>
      
      </div></div></div>
  
  <div class="panel panel-warning">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-12">
       12) Why do I have different results for 'Mental Retardation' with 'Mental Disorder'?
        </a>
      </h4>
    </div>
    <div id="collapse-12" class="panel-collapse collapse">
      <div class="panel-body"><p>
       As the workflow explained, Phenolyzer is not the god who knows everything you mean. It is just an advanced word matcher, which needs to exactly match
       your input terms with disease names in the databases. Thus it is encouraged to use multiple terms if you cannot describe something very precisely, in this case, you can
       just enter 'mental', or you can enter both, like 'mental retardation;mental disorder'.</p>
      
      </div></div></div>
  
       <div class="panel panel-success">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-14">
       13) How could I add my own seed genes?
        </a>
      </h4>
    </div>
    <div id="collapse-14" class="panel-collapse collapse">
      <div class="panel-body">
    <p> Please compile your seed genes in the format(tab_delimited), and save the file in PHENOLYZER_DIR/lib/compiled_database: <br>
    Afterwards please use -addon_gg [your_filename] -addon_gg_weight [weight] in your command line.
    </p>
    <table class="table table-striped table-bordered">
    <tr><th>Entrez Gene A </th><th> Entrez Gene B </th> <th>Evidence description </th><th> Normalized score (0 to 1)</th> <th>Source (Pubmed ID)</th></tr> 
    <tr><td>BARD1</td><td>DCAF7</td><td>Mentha protein interaction</td><td>0.126</td><td>22990118</td></tr>
    
    </table>
     
         </div>
    </div>
  </div>
      
       <div class="panel panel-success">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-15">
       14) How could I add my own gene-gene interactions?
        </a>
      </h4>
    </div>
    <div id="collapse-15" class="panel-collapse collapse">
      <div class="panel-body">
    <p> Please compile your gene-gene interaction in the format below (tab-delimited), and save the file in PHENOLYZER_DIR/lib/compiled_database: <br>
    Afterwards please use -addon_gg [your_filename] -addon_weight [weight] in your command line.
    </p>
    <table class="table table-striped table-bordered">
    <tr><th>Entrez Gene </th><th> Disease name </th> <th>Reference </th><th> Normalized score (0 to 1)</th> <th>Source</th></tr> 
    <tr><td>CCR5 </td><td>acquired immunodeficiency syndrome</td><td>PUBMED:21502085</td><td>0.00595238095238095</td><td>GAD</td></tr>
    
    </table>
     
         </div>
    </div>
  </div>
  
  <div class="panel panel-danger">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-16">
       15) Why are all the scores positive?
       
        </a>
      </h4>
    </div>
    <div id="collapse-16" class="panel-collapse collapse">
      <div class="panel-body">
    <p> 
      1) we want to correctify a typo in the Nature Methods paper, in Page 5 Paragraph 5 Line 3, the 'wTXn-X0' should be 'wTxn - X0w0'.
      2) The final score is the linear output instead of the logistic probability. All the weights except the intercept are promised to be positive. Thus to make
      	sure our final score is positive, the negative intercept is deducted.
     </p>
         </div>
    </div>
  </div>
  
  <div class="panel panel-danger">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-17">
       16) What does it mean if I separate my term 'acute lymphocytic leukemia' as 'acute;lymphocytic;leukemia'?
        </a>
      </h4>
    </div>
    <div id="collapse-17" class="panel-collapse collapse">
      <div class="panel-body">
    <p> A delimiter like ';' or Enter means you treat them as different terms. Then any disease name containing 'acute''lymphocytic'
        or 'leukemia' will be considered. But we have a Weighted Sum system to combine your terms, thus the most specific term
        will be dominant and its corresponding genes will be prioritized on top. Multiple short terms should be considered when you want a 
        better recall. </p>
         </div>
    </div>
  </div>
  
   <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-18">
       17) How could I get the structured output for Cytoscape?
        </a>
      </h4>
    </div>
    <div id="collapse-18" class="panel-collapse collapse">
      <div class="panel-body">
    <p> The structured output file is called 'network.json' and it is in the result URL directory.
     One example is shown: http://phenolyzer.wglab.org/done/1/dIv3Tz6iaSVHA1_J/network.json
     <br>You need to modify the URL yourself as there is no direct link for download!
    
     </p>
         </div>
    </div>
  </div>
  
</div>	</div>
		<!-- container -->
            <div class="container">
     <div class="footer col-lg-offset-1">
        <p class="text-muted">All Rights Reserved @Wang Genomics Lab 2010-<script type="text/javascript">document.write(new Date().getFullYear());
</script></p>
      </div></div>     
                
                 
               
               
                 
                 
             
	</body>
</html>
