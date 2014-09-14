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
          <a class="navbar-brand" href="http://phenolyzer.usc.edu"><p class="title">Phenolyzer</p></a>
		 
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li><a href="http://phenolyzer.usc.edu">Home</a></li>	
			   	<li><a href="http://phenolyzer.usc.edu/download.php">Download</a></li>
			   	<li><a href="http://phenolyzer.usc.edu/tutorial.php">Tutorial</a></li>
			   	<li class="active" ><a href="http://phenolyzer.usc.edu/FAQ.php">FAQ</a></li>
			   	<li><a href="http://phenolyzer.usc.edu/example.php">Example</a></li>
			   	
			  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Related projects<span class="caret"></span></a>
		    <ul class="dropdown-menu" role="menu">
                   <li><a href="http://wannovar3.usc.edu">wANNOVAR</a></li>
                    <li><a href="http://icages.usc.edu:5000/">iCAGES</a></li>
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
	<div class="col-lg-10 col-lg-offset-1" >
  <h1>Frequently Asked Questions</h1>
  <p>Want to learn more about Phenolyzer? This is the right place! This section will go over with you about some common questions!</p> 

  </p></div></div></div>
  
		<div class="container faq">
		<div class="panel-group col-lg-10 col-lg-offset-1" id="accordion">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a  data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
         What is Phenolyzer?
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
       <p>Phenolyzer is Phenotype based Gene Analyzer.</p>
       </div>
    </div>
  </div>
  <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          What does Phenolyzer do?
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
  <div class="panel panel-warning">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          How does Phenolyzer work?
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
          What terms does Phenolyzer accept?
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
         What should I do if I don't know a specific disease/phenotype right now?
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
        What other inputs do Phenolyzer accept?
        </a>
      </h4>
    </div>
    <div id="collapse-6" class="panel-collapse collapse">
      <div class="panel-body">
    <p>1) A gene list, (Entrez Genes or IDs, lower case is accepted). <a href="http://phenolyzer.usc.edu/download/genelist.txt"><span class="label label-success">Example</span></a>
			<br>
           2) A region file, in '.bed' format. <a href="http://phenolyzer.usc.edu/download/cnv.bed"><span class="label label-success">Example</span></a></p>
         </div>
    </div>
  </div>
  
    <div class="panel panel-danger">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-7">
        What if Phenolyzer doesn't have records for my term?
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
       What types of databases do Phenolyzer use?
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
       What are in the output?
        </a>
      </h4>
    </div>
    <div id="collapse-9" class="panel-collapse collapse">
      <div class="panel-body">
    <p>1) An interactive gene-disease network plot is on top.
			<br><br><img src="images/network.jpg" alt="network" width="600"/>
		    <br><br>  2) The disease names interpreting your terms are in separate files.
		    <br><br> For each term ,there is a corresponding file, in the form of 'disease names' 'source', where 
		         'disease names' are speparated by semicolon, 'source' includes 'CTD_DISEASE' 'DISEASE_ONTOlOGY' 
		         'GENE_DISEASE'. Also, a<a href="http://phenolyzer.usc.edu/done/2014/VYZiDTkhFO12vLXS/out_cancer_wordcloud.png"> <span class="label label-info">WordCloud</span></a>
		         based on the interpretation is also available.           
			
			<br>  3)  The detailed reports and normalized gene lists, for all the genes or reported genes only, or 
			      with gene/region selections.
			<br><br>  The detailed reports is in the forms 'Gene Infomation', 'block of details'.
			<br><br>  The Gene Information contains the Entrez Gene symbol, Gene ID, Position (If it is in your input region), 
			      status (Reported or Predicted), and Scores (conditional probability for the seed genes, 
			      absolute scores without normalization for the final report).  
			<br><br> For a gene-disease relation, the detail contains the Pubmed or data source ID, 
			         the exact disease name, the corresponding term, and the contributing score.
			<br><br> For a gene-gene relation, the detail contains the Pubmed or data sourcr ID,
			         The exact relation type, the related gene, and the contributing score.    
			          
		    <br>  4) A barplot of at most top 500 genes is also available.
	     	<br>  5) Details: The top 50 genes will be presented with the links to the each data source. 
			<br>  The link of the gene in NCBI, the data source, and the relation evidence are sparately highlighted.
			<br><br><img src="images/top50.jpg" alt="top50" width="700"/></p>    
			<br>  		
			</div>
    </div>
  </div>
  
    <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-10">
       How could I understand the network?
        </a>
      </h4>
    </div>
    <div id="collapse-10" class="panel-collapse collapse">
      <div class="panel-body">
      <p>The network includes the top50 prioritized genes, and their associated diseases and relations within each other.
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
        How could I play with the network?
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
       is shaped, by default it is force-driven, but by changing option here one can make it more organized, like 'circle' layout:)
       <br>
       By the way, why not just save a photo of your network and demonstrated others with it? Just click the Save Photo button:)
      </p>
      
      </div></div></div>
  
  <div class="panel panel-warning">
    <div class="panel-heading">
      <h4 class="panel-title big-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-12">
        Why do I have different results for 'Mental Retardation' with 'Mental Disorder'?
        </a>
      </h4>
    </div>
    <div id="collapse-12" class="panel-collapse collapse">
      <div class="panel-body"><p>
       As the workflow explained, Phenolyzer is not the god who knows everything you mean. It is just an advanced word matcher, which needs to exactly match
       your input terms with disease names in the databases. Thus it is encouraged to use multiple terms if you cannot describe something very precisely, in this case, you can
       just enter 'mental', or you can enter both, like 'mental retardation;mental disorder'.</p>
      
      </div></div></div>
      
      
  
</div>	</div>
		<!-- container -->
            <div class="container">
     <div class="footer col-lg-offset-1">
     <p class="text-muted">Rights Reserved @Hui Yang USC Neuroscience</p>
      </div></div>     
                
                 
               
               
                 
                 
             
	</body>
</html>