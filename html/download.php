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

          <!--a class="navbar-brand" href="http://phenolyzer.wglab.org"><p class="title">Phenolyzer</p></a-->
		 
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li><a href="/">Home</a></li>	
			   	<li class="active" ><a href="/download.php">Download</a></li>
			   	<li><a href="/tutorial.php">Tutorial</a></li>
			   	<li><a href="/FAQ.php">FAQ</a></li>
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
	<div class="col-lg-8 col-lg-offset-1" >
  <h1>Download</h1>
  <p>One sample gene list and one bed file are avialable to download here. Besides, the linux command line standalone Phenolyzer is
  also available to download, with which, you can conduct large-scale and automatic analysis your self. Is this amazing?</p> 

  </p></div></div></div>
  
		<div class="container">
		 <div class="col-md-5 col-md-offset-1"  >
		 <div class="panel panel-danger">
      <div class="panel-heading">
			<h3 class="panel-title  big-title">Sample Input</h3></div>
			<div class="panel-body">
			 <h3 class="text-danger"><span class="glyphicon glyphicon-ok"></span>
			 <a  class="text-danger" href="/download/genelist.txt">
			Sample Gene List</a></h3>
			<h3 class="text-danger"><span class="glyphicon glyphicon-ok"></span>
		    <a  class="text-danger"href="/download/cnv.bed">
			Sample Region bed file</a></h3>
			</div></div></div>
			<div class="col-md-5" >
			 <div class="panel panel-info">
            <div class="panel-heading">
			<h3 class="panel-title  big-title">Phenolyzer Command Line Tool</h3></div>
			<div class="panel-body">	
		   	<h3 class="text-info"><span class="glyphicon glyphicon-ok"></span>
			<a class="text-info" href="https://github.com/WGLab/phenolyzer">
			Github </a></h3>
			</div>
		
		 </div></div>
		</div>
		<!-- container -->
            <div class="container">
     <div class="footer col-lg-offset-1">

        <p class="text-muted">All Rights Reserved @Wang Genomics Lab 2010-<script type="text/javascript">document.write(new Date().getFullYear());
</script></p>

      </div></div>      
                
                 
               
               
                 
                 
             
	</body>
</html>
