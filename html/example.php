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
        <div class="navbar-header col-md-2">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><p class="title">Phenolyzer</p></a>
		 
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li><a href="http://phenolyzer.usc.edu">Home</a></li>	
			   	<li><a href="/download.php">Download</a></li>
			   	<li><a href="/tutorial.php">Tutorial</a></li>
			   	<li ><a href="/FAQ.php">FAQ</a></li>
			   	<li  class="active"><a href="/example.php">Example</a></li>
			   	<li><a href="/cgi-bin/phenohub.cgi">Phenohub</a></li>
			   	
			  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Related projects<span class="caret"></span></a>
		    <ul class="dropdown-menu" role="menu">
                   <li><a href="http://wannovar.wglab.org">wANNOVAR</a></li>
                    <li><a href="http://icages.wglab.org">iCAGES</a></li>
                    <li><a href="http://enlight.wglab.org">Enlight</a></li>
                    <li><a href="http://seqmule.wglab.org">SeqMule</a></li>
                  </ul>
                </li>
          </ul>
		  <div class="navbar-header navbar-right col-md-3" >
		    <a class="title navbar-brand" href="http://wglab.org"><img src="/img/logo.png" alt="" style="height:100%;"></a>
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
			<h3 class="panel-title  big-title">Some pregenerated examples could be found below <br>(Caution: they might not be updated!) </h3>
			</div>
			  <div class="panel-body">
			
           <h3 class="text-primary"><span class="glyphicon glyphicon-ok"></span><a href="/done/4738/1_OXoD4WszZeFicS/index.html">    Amyotrophic lateral sclerosis</a></h3> 
		     <h3 class="text-primary"><span class="glyphicon glyphicon-ok"></span><a href="/done/4737/uutz_AeaS4TkwBjI/index.html">  Cancer</a></h3>
		     <h3 class="text-primary"><span class="glyphicon glyphicon-ok"></span><a href="/done/8799/aL4IFnI04-dCKiK9/index.html">  Autism</a></h3>
		    <h3 class="text-primary"><span class="glyphicon glyphicon-ok"></span><a href="/done/10901/pFsk41MHw4ceYCAn/index.html">  Huntington</a></h3>
		    
		    
		    </div>
        </div>
        <div class="panel panel-primary">    
           <div class="panel-heading">
    <h3 class="panel-title  big-title">Sample commands for Phenolyzer command line tools:</h3></div>
            <div class="panel-body">
             <table class="table table-striped">		 
            <tr><td>Help: <br><br><code>perl disease_annotation.pl --help</code></td></tr>	
            <tr><td>Prioritize 'sleep' genes: 
            <br><br><code>perl disease_annotation.pl sleep -p -ph -logistic -out out/sleep/out </code></td></tr>	  
			<tr><td>Use the terms in 'disease' file: 
			<br><br><code>perl disease_annotation.pl disease -f -p -ph -logistic -out out/disease/out </code></td></tr>
			<tr><td>Use the cnv.bed region: 
			<br><br><code>perl disease_annotation.pl alzheimer -bedfile cnv.bed -p -ph -logistic -out out/alzheimer/out </code> </td></tr>
			<tr><td>Use the Mentha gene-gene interaction database as Addon 
			<br><br><code>perl disease_annotation.pl alzheimer -p -ph -logistic -out out/alzheimer_addon/out -addon_gg DB_MENTHA_GENE_GENE_INTERACTION -addon_gg_weight 0.05</code> </td></tr>
			</table>
			</div>
			</div>
			</div>
  	</div>
		<!-- container -->
                 <div class="container">
     <div class="footer col-lg-offset-1">
         <p class="text-muted">Rights Reserved @Wang Lab, Powered By Hui Yang USC Neuroscience</p>
      </div></div> 
                
                 
               
               
                 
                 
             
	</body>
</html>
