<!DOCTYPE html>

<html>
<meta charset="utf-8"> 
	<head>
		<title>Phenolyzer: Phenotype based gene analyzer</title>
        <link href="http://phenolyzer.usc.edu/css/redmond/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" >
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
			
			
        	<section class="form">
        	<h2 class="gene_prioritization" title="">Gene Prioritization</h2> 
        	
			<form action="/cgi-bin/loh.cgi" method="post" ENCTYPE="multipart/form-data">
			   
			  <fieldset class="input_form">
			  <div id="input_form">
			 <legend id="top">INPUT FORM</legend>
               <label for="email"> Email </label> <input title="" type="text" name="email" id="email"  > 
			   <label class="disease" title="">Diseases/Phenotypes</label>
                 <textarea required id="disease" title="" placeholder="Please enter your diseases:  (maxlength:400)" name="disease" maxlength="400"></textarea>
                 </div>
                 
                 <div id="options">
                 <legend class="sub">OPTIONS</legend>   
                                  
                 <label class="weight_adjust_options" title="">Weight Adjust  </label>
                 <select id="weight_adjust_options"  name="weight_adjust" >
                 <option selected value="no" >No</option>
                 <option value="yes"  >Yes</option>
                 </select>               
                 
                 <label class="gene_selection_options" title="">Gene Selection  </label>
                 <select id="gene_selection_options"  name="gene_selection">
                 <option selected value="no" >No</option>
                 <option value="yes"  >Yes</option>
                 </select>
                 
                  <label class="region_selection_options" title="">Region Selection  </label>
                 <select id="region_selection_options"  name="region_selection" >
                 <option selected value="no" >No</option>
                 <option value="yes"  >Yes</option>
                 </select>

                 
                 <label for="other_options" class="advanced_options" title = "">Advanced Options  </label>
                 <select id="other_options" name="other_options">
                 <option selected value="phenotype_interpretation" >Phenotype Interpretation</option>
                 <option value="none" >Disease Only</option>
                 <option value="all_diseases" >Select all diseases</option>
                 </select>
                 </div>
                 
                 <div id="gene_selection">
                 <legend class="sub" >GENE SELECTION</legend>
                 <label>Gene List  </label>             
                 <textarea title="" id="genelist" placeholder="Please enter your genelist" name="genelist" ></textarea>
                 </div>
                   
                 <div id="region_selection">
                 <legend class="sub">REGION SELECTION</legend>                
                 <label for="bedfile" title="">BED file   </label>
                 <a id="bed_instruction" href="https://genome.ucsc.edu/FAQ/FAQformat.html#format1" target="_blank"><img src="http://phenolyzer.usc.edu/images/button_question_2.jpg" alt="" width="15" height="15" /></a>      
                 <input id="bedfile" type="file" class="upload" name="bedfile" />
                 <label for="buildver" title="">Genome Build   </label>
                 <select id="buildver" name="buildver">
                 <option value="hg18" >hg18</option>
                 <option selected value="hg19" >hg19</option>
                 </select>
                 </div>
                 
                 <div id="weight_adjust">
                 <legend class="sub">WEIGHT ADJUST</legend>   
                 <section id="gene_disease">             
                 <label for="GWAS"> GWAS  </label> <input title="" name="GWAS" id="GWAS" value="1" > 
                 <label for="OMIM"> OMIM  </label> <input tittle="" name="OMIM" id="OMIM" value="1"> 
                 <label for="CLINVAR"> ClinVar  </label> <input tittle="" name="CLINVAR" id="CLINVAR" value="1"> 
                 <label for="ORPHANET"> Orphanet  </label> <input tittle="" name="ORPHANET" id="ORPHANET" value="1"> 
                 <label for="GENE_REVIEWS"> Gene Reviews  </label> <input tittle="" name="GENE_REVIEWS" id="GENE_REVIEWS" value="1"> 
                 </section>
                 <section id="gene_prediction">             
                 <label for="HPRD"> HPRD  </label> <input tittle="" name="HPRD" id="HPRD" value="0.10"> 
                 <label for="BIOSYSTEM"> Biosystem  </label> <input tittle="" name="BIOSYSTEM" id="BIOSYSTEM" value="0.05"> 
                 <label for="HGNC"> Gene Family</label> <input tittle="" name="HGNC" id="HGNC" value="0.05"> 
                 <label for="HTRI"> HTRI  </label> <input tittle="" name="HTRI" id="HTRI" value="0.05"> 
                 </section>
                 </div>
                 
                 <div id="submit">
                 <legend class="sub">SUBMIT</legend>
                 <input name="submit" class="button" type="submit" value="submit">
                 <a href="http://phenolyzer.usc.edu" ><button type="button">Reset</button>
                 <a href="/cgi-bin/job.cgi" target="_blank" ><button type="button">monitor jobs</button></a> 
                 </div>
                 
               
                 </fieldset>
                 <input type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" name="ip" />
                 <input type='hidden' value='<?php echo GetHostByAddr($_SERVER['REMOTE_ADDR']); ?>' name='host'>
                  </form> 
                  <script type="text/javascript"  src="http://phenolyzer.usc.edu/jquery-1.11.0.min.js"></script>
	              <script type="text/javascript"  src="http://phenolyzer.usc.edu/js/jquery-ui-1.10.4.custom.min.js"></script>
	              <script type="text/javascript"  src="http://phenolyzer.usc.edu/form_control_1.js"></script>
				  
				 
				 
				 
			</section>
			<footer>
				&copy; 2014 Hui Yang USC Neruoscience
			</footer>
		</div><!-- .wrapper -->
	</body>
</html>