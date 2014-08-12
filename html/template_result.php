<!DOCTYPE html>
<html>
	<head>
		<title>Phenolyzer: Phenotype Based Gene Analyzer</title>
		<link href="http://phenolyzer.usc.edu/PGA.css" rel="stylesheet" type="text/css" >
		<link href="http://phenolyzer.usc.edu/css/jquery.cytoscape.js-panzoom.css" rel="stylesheet" type="text/css" />
		<link href="http://phenolyzer.usc.edu/font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />	
		<link href="http://phenolyzer.usc.edu/css/redmond/jquery-ui.css" rel="stylesheet"> 
		             
        <script type="text/javascript"  src="http://phenolyzer.usc.edu/jquery-1.11.0.min.js"></script> 
        <script type="text/javascript"  src="http://phenolyzer.usc.edu/js/jquery-ui-1.10.4.custom.js" ></script> 
		
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body id="result">
	<div id="dialog" title="Loading">
    <p>Please wait while the data is loading...... </p>
    <img id="loader" src="http://phenolyzer.usc.edu/images/ajax-loader.gif" ></img>
    </div>
    <script type="text/javascript">
        $( "#dialog" ).dialog({width:450, height:240, draggable: false, 
            closeOnEscape: false,resizable: false });
        $( "#dialog" ).dialog( "option", "modal", true );
        $('#dialog').dialog({ dialogClass: "flora" });
        $('.flora.ui-dialog').css({ position:'fixed' });
        </script>   
		<div class="wrapper weaker" >
			<header>
				<h1>Phenolyzer: Phenotype Based Gene Analyzer</h1>
				<nav>
					<ul>
						<li><a href="http://phenolyzer.usc.edu">home</a></li>	
						<li><a href="http://phenolyzer.usc.edu/download.php">download</a></li>
						<li><a href="http://phenolyzer.usc.edu/FAQ.php">FAQ</a></li>
						<li><a href="http://phenolyzer.usc.edu/contact.php">contact</a></li>
						<li><a href="http://phenolyzer.usc.edu/release_note.php">release note</a></li>
						<li><a href="http://phenolyzer.usc.edu/example.php">example</a></li>
					</ul>
				</nav>
			</header>
			%%%%Network%%%%
			<section class="results">
			%%%%Content%%%%  
			
			</section>
				 
				 
		
			<footer>
				&copy; 2014 Hui Yang USC Neruoscience
			</footer>
		</div><!-- .wrapper -->
	</body>
</html>