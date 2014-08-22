<!DOCTYPE html>
<html>
	<head>
		<title>Phenotype based gene analyzer</title>
		<link href="http://phenolyzer.usc.edu/PGA.css" rel="stylesheet" type="text/css" >
			
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="wrapper">
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
			<h2 class="example">Example</h2>
			<section class="example">
			<ul>
			<li>Some pregenerated examples could be found below</li>
			<br>
            <li><a href="http://phenolyzer.usc.edu/done/1807/g077ChQKVBKF536Q/index.html">Amyotrophic lateral sclerosis</a></li> 
		    <li><a href="http://phenolyzer.usc.edu/done/1888/eCW6LSjT5gV8MY6E/index.html">Cancer</a></li> 
		    <li><a href="http://phenolyzer.usc.edu/done/1885/MubDtyTIbaffaIQq/index.html">Autism</a></li> 
		    
            <br><hr><br>
            
            <li>Sample commands for Phenolyzer command line tools:</li>		 
            <li>Help: <br>perl disease_annotation.pl --help</li>	
            <li>Prioritize 'sleep' genes: <br>perl disease_annotation.pl sleep -p -ph -logistic -out sleep/out </li>	  
			<li>Use the terms in 'disease' file: <br>perl disease_annotation.pl disease -f -p -ph -logistic -out disease/out </li>
			<li>Use the cnv.bed region: 
			<br>perl disease_annotation.pl alzheimer -bedfile cnv.bed -p -ph -logistic -out alzheimer/out </li>
			</ul>
			</section>
				 
				 
		
			<footer>
				&copy; 2014 Hui Yang USC Neruoscience
			</footer>
		</div><!-- .wrapper -->
	</body>
</html>