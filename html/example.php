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
			   	<li ><a href="http://phenolyzer.usc.edu/FAQ.php">FAQ</a></li>
			   	<li  class="active"><a href="http://phenolyzer.usc.edu/example.php">Example</a></li>
			   	
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
	<div class="col-lg-8 col-lg-offset-1 " >
  <h1>Example</h1>
  <p>Still not understand how to use Phenolyzer? Not a big deal, try some exciting examples here!
  </p></div></div></div>
  
		<div class="container">
		<div class="col-lg-10 col-lg-offset-1 " >
		<div class="panel panel-primary">
      <div class="panel-heading">
			<h3 class="panel-title  big-title">Some pregenerated examples could be found below</h3>
			</div>
			  <div class="panel-body">
			
           <h3 class="text-primary"><span class="glyphicon glyphicon-ok"></span><a href="http://phenolyzer.usc.edu/done/2013/Ty7BUwEKUy7wDlvy/index.html">    Amyotrophic lateral sclerosis</a></h3> 
		     <h3 class="text-primary"><span class="glyphicon glyphicon-ok"></span><a href="http://phenolyzer.usc.edu/done/2014/VYZiDTkhFO12vLXS/index.html">  Cancer</a></h3>
		     <h3 class="text-primary"><span class="glyphicon glyphicon-ok"></span><a href="http://phenolyzer.usc.edu/done/2263/GtQ7PD_yx2SoZgkf/index.html">  Autism</a></h3>
		    <h3 class="text-primary"><span class="glyphicon glyphicon-ok"></span><a href="http://phenolyzer.usc.edu/done/2007/Ce7EKsKacUsybr5Z/index.html">  Huntington</a></h3>
		    
		    </div>
        </div>
        <div class="panel panel-primary">    
           <div class="panel-heading">
    <h3 class="panel-title  big-title">Sample commands for Phenolyzer command line tools:</h3></div>
            <div class="panel-body">
             <table class="table table-striped">		 
            <tr><td>Help: <br><br><code>perl disease_annotation.pl --help</code></td></tr>	
            <tr><td>Prioritize 'sleep' genes: 
            <br><br><code>perl disease_annotation.pl sleep -p -ph -logistic -out sleep/out </code></td></tr>	  
			<tr><td>Use the terms in 'disease' file: 
			<br><br><code>perl disease_annotation.pl disease -f -p -ph -logistic -out disease/out </code></td></tr>
			<tr><td>Use the cnv.bed region: 
			<br><br><code>perl disease_annotation.pl alzheimer -bedfile cnv.bed -p -ph -logistic -out alzheimer/out </code> </td></tr>
			</table>
			</div>
			</div>
			</div>
  	</div>
		<!-- container -->
                 <div class="container">
     <div class="footer col-lg-offset-1">
     <p class="text-muted">Rights Reserved @Hui Yang USC Neuroscience</p>
      </div></div> 
                
                 
               
               
                 
                 
             
	</body>
</html>