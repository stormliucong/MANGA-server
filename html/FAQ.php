<!DOCTYPE html>
<html>
	<head>
		<title>Phenotype based gene analyzer</title>
		<link href="http://phenolyzer.usc.edu/PGA.css" rel="stylesheet" type="text/css" >
		<link href="http://phenolyzer.usc.edu/css/redmond/jquery-ui.css" rel="stylesheet">                 
        <script type="text/javascript"  src="http://phenolyzer.usc.edu/jquery-1.11.0.min.js"></script>
         <script type="text/javascript"  src="http://phenolyzer.usc.edu/js/jquery-ui-1.10.4.custom.js" ></script> 	
         <script type="text/javascript"  src="http://phenolyzer.usc.edu/FAQ.js"></script>
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body id="FAQ">
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

			<section class="Faq">
		    <h2 class="Faq">Frequently Asked Questions</h2>
			<div id="Faq-accordion">
			<h3 class="Faq-odd Faq"><span>What is Phenolyzer?</span></h3>
			<p>Phenolyzer is Phenotype based Gene Analyzer.</p>
			<h3 class="Faq-even Faq"><span>What does Phenolyzer do?</span></h3>
			<p>Phenolyzer takes as input a discrete list of phenotype terms and generate a list of 
			candidate genes weighted by the chance of being associated with the phenotype, even in the absence of any genotype data.</p>
			<h3 class="Faq-odd Faq"><span>How does Phenolyzer work?</span></h3>
			<p>First, Phenolyzer interprets your term into a set of professional disease names;
			<br>Second, Phenolyzer finds all the genes having a reported association with all the diseases;
			<br>Thirdly, Phenolyzer grows the genes found into gene-gene relation databases and get more genes;
			<br>Finally, Phenolyzer integrates all the infomation together and give gene scores.
			<br><br> <img src="images/Phenolyzer_workflow.png" alt="workflow" width="700" /></p>
			
			<h3 class="Faq-even Faq"><span>What terms does Phenolyzer accept?</span></h3>
			<p>1) Disease terms, separate by semicolon or return. 
			      For example, 'Alzheimer disease'
			  <br>     
			  <br>    <img src="images/disease_term.jpg" alt="disease_term" width="700"/>
			  <br><br>  2)  Phenotype terms, if Phenotype interpretation is selected in advanced options.
			      For example, 'headache; fatigue'
			  <br><br>    
			  <img src="images/phenotype_term.jpg" alt="phenotype_term" width="700"/></p>
			  
			<h3 class="Faq-odd Faq"><span>What should I do if I don't have an idea about disease/phenotypes?</span></h3>
			<p>Choose 'All Diseases' in Advanced Option
			<br><br>
			<img src="images/all_diseases.jpg" alt="all_diseases" width="700"/></p>
			
			<h3 class="Faq-even Faq"><span>What other inputs do Phenolyzer accept?</span></h3>
			<p>1) A gene list, NCBI's entrez identifier is required, lower case is accepted.
			<br><br>
			<img src="images/Gene_list.jpg" alt="Gene_list" width="700"/>
		    <br><br>2) A region file, in '.bed' format.
		    <br><br>
		    <img src="images/Region_selection.jpg" alt="region_selection" width="700"/></p>
		    
			<h3 class="Faq-odd Faq"><span>What if Phenolyzer doesn't have records for my term?</span></h3>
			<p>Phenolyzer needs to match your term in its database. If a term is not found, useually it is because your term
			is too long. Please try to break your long term into several short terms.</p>
			
			<h3 class="Faq-even Faq"><span>What types of databases do Phenolyzer use?</span></h3>
			<p>1) Disease Databases: CTD's Medic disease vocabulay, Disease Ontology, OMIM's disease synonyms
			<br>2) Gene-Disease Databass: OMIM (Online Mendelian In Man), NCBI's ClinVar, GeneReviews, Orphanet, GWAS Catalog
         	<br>3) Gene-Gene Relation Databases: HPRD (Human Protein Relation Database), NCBI's Biosystem, HGNC Gene Family, HTRI(Human Transcription Interaction)</p>
			<h3 class="Faq-odd Faq"><span>Could I selectively neglect one or multiple databases?</span></h3>
			<p>Yes, you can. Please turn on Weight Adjust, and set 0 for the database you don't want.
			<br><br> 
			<img src="images/weight_adjust.jpg" alt="weight_adjust" width="700"/></p>
			
			<h3 class="Faq-even Faq"><span>What are in the output?</span></h3>
			<p>1) An interactive gene-disease network plot is on top.
			<br><br><img src="images/network.jpg" alt="network" width="600"/>
		    <br><br>  2) The disease names interpreting your terms are in separate files.
		    <br><br> For each term ,there is a corresponding file, in the form of 'disease names' 'source', where 
		         'disease names' are speparated by semicolon, 'source' includes 'CTD_DISEASE' 'DISEASE_ONTOlOGY' 
		         'GENE_DISEASE'.           
			<br><br><img src="images/result_disease.jpg" alt="result_disease" width="500"/>
			<br>  3) The detailed reports and normalized gene lists, for all the genes or reported genes only, or 
			      with gene/region selections.
			<br><br>  The detailed reports is in the forms 'Gene Infomation', 'block of details'.
			<br><br>  The Gene Information contains the Entrez Gene symbol, Gene ID, Position (If it is in your input region), 
			      status (Reported or Predicted), and Scores (conditional probability for the seed genes, 
			      absolute scores without normalization for the final report).  
			<br><br> For a gene-disease relation, the detail contains the Pubmed or data source ID, 
			         the exact disease name, the corresponding term, and the contributing score.
			<br><br> For a gene-gene relation, the detail contains the Pubmed or data sourcr ID,
			         The exact relation type, the related gene, and the contributing score.    
			          
		    <br><br><img src="images/result_report.jpg" alt="result_report" width="500"/>    
	     	<br>  4) The top 50 genes will be presented with the links to the each data source. 
			<br>  The link of the gene in NCBI, the data source, and the relation evidence are sparately highlighted.
			<br><br><img src="images/top50.jpg" alt="top50" width="700"/></p>
			 
			<h3 class="Faq-odd Faq"><span>How could I understand the network?</span></h3>
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
			
			</section>
				 
				 
		
			<footer>
				&copy; 2014 Hui Yang USC Neruoscience
			</footer>
		</div><!-- .wrapper -->
	</body>
</html>