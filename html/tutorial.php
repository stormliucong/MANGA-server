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
			   	<li class="active" ><a href="/tutorial.php">Tutorial</a></li>
			   	<li><a href="/FAQ.php">FAQ</a></li>
			   	<li><a href="/example.php">Example</a></li>
			   	<li><a href="/cgi-bin/phenohub.cgi">Phenohub</a></li>
			   	
			  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Related projects<span class="caret"></span></a>
		    <ul class="dropdown-menu" role="menu">
                  <li><a href="http://phenolyzer.wglab.org/">Phenolyzer</a></li>
                    <li><a href="http://icages.wglab.org">iCAGES</a></li>
                    <li><a href="http://enlight.wglab.org">Enlight</a></li>
                    <li><a href="http://seqmule.usc.edu/">SeqMule</a></li>
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
  <h1>Tutorial</h1>
  <p>This tutorial gives you a quick start to use Phenolyzer!</p> 
  
  </div></div></div>
   
  <div class="container">
   <div class="col-md-offset-1">
   <h3 id="mannual" class="page-header text-primary">Mannual</h3>
   <p> A detailed mannual can be downloaded <a href="/download/Phenolyzer_manual.pdf">here</a>.</p>
	<h3 id="QuickStart" class="page-header text-primary">Quick Start</h3>  
	<p>Follow the instructions below: get to the homepage, enter the disease or phenotype, enter your email if you wannt to recevie 
	 email for notification. Than submit!</p>
	 <p><strong>Gene Selection</strong> and <strong>Region Selection</strong> are selected to conduct region specific and 
	 gene specific prioritization. </p>
	 <p><strong>Advanced Options</strong> could be chosen to shut off the Phenotype interpretation, or choose all diseases.</p>
	 <p><strong>Weight Adjust</strong> could be chosen to adjust the weights of different databases, or selectively shut off 
	 some databases by setting 0.</p>
    <img src="images/tutorial/tutorial1.PNG" width="1000px"/> 
    <h3 id="ResultPage" class="page-header text-primary">Result</h3>  
    <p>Usually in 30 seconds, the result page will show up (several minutes if you choose Word Cloud).</p>
    <p>There are four types of contents in the result page</p>
    <p><strong>Network</strong> is the gene-gene-disease interaction network. The interactive options are highlighted below.</p>
    <img src="images/tutorial/tutorial3.PNG" width="1000px"/> 
    <p><strong>Summary</strong> is the summary of the result. Including the download links of the report, genelist and the interpreted diseases.
    <p><strong>Interpreted Diseases</strong> are the specific diseases names and synonyms separated by semicolon, followed by the data source or reliability(tab as delemiter)
    , corresponding to each disease/phenotype term.</p>
    <p><strong>Word Cloud</strong> tag is shown up if you have selected 'WordCloud' option in the submission form.
    <p><strong>Report</strong> is the report containing the detailed information of each gene in the result, including each relation 
    with the disease and seed genes.</p>
    <p><strong>Gene Scores</strong> are just a list with 'Rank''Gene''Entrez ID''Score', separated by tab.</p>
    <img src="images/tutorial/tutorial2.PNG" width="1000px"/>
    <p><strong>Barplot</strong> shows at most top 500 genes. Users could click the gene name to go to the NCBI website of this gene.
    The bar could also be clicked to see its details. What should be NOTICED is some lower score genes might not have details available, due to
    too many details. The score is right beside each bar. </p>
    <img src="images/tutorial/tutorial4.PNG" width="1000px" />
    <p><strong>Detials</strong> present the details for 5o genes per page and at most 2000 genes in total. The button set on the top
    could be used to change page. The meaning of each item is explained in the figure below. </p>
    <img src="images/tutorial/tutorial5.PNG" width="1000px" />
   
  </div></div>
		<!-- container -->
            <div class="container">
     <div class="footer col-lg-offset-1">
     <p class="text-muted">Rights Reserved @Hui Yang USC Neuroscience</p>
      </div></div>     
                
                 
               
               
                 
                 
             
	</body>
</html>
