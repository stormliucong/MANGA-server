<html>
    
<head>
<title> Phenotype Based Genomic Region Analyzer </title>
</head>
 <link rel="stylesheet" type="text/css" href="loh.css"/>
 
<body>

<h1 id="grad"> Phenotype Based Genomic Region Analyzer  </h1>
<ul clas="saturday">
<li><a href="http://loh2.usc.edu">Home</a></li>
<li><a href="http://www.omim.org/">OMIM</a></li>
<li><a href="http://www.human-phenotype-ontology.org/">HPO</a></li>
<li><a href="http://www.orpha.net/">Orphanet</a></li>
<li><a href="https://www.ncbi.nlm.nih.gov/clinvar/"> ClinVar</a></li>
</ul>

<br>
<p class="h1">
   Input BED files and optionally candidate gene list file and phenotype description to obtain prioritized gene list
  </p>

<hr>
 
   
<form action="/cgi-bin/loh.cgi" method="post" ENCTYPE="multipart/form-data">
<table>

<tr> <td> Email (Optional): </td> <td> <input type="text" name="email" size=50 > </td> </tr>
<tr> <td> BED file: <a href="https://genome.ucsc.edu/FAQ/FAQformat.html#format1">?</a> </td> <td> <input type="file" required="required" name="bedfile"> </td> </tr>
<tr> <td> Genome build: </td> <td> 
    <input id="hg19" name="buildver" type="radio" value="hg19" checked="checked" /> <label for="hg19"> hg19/NCBI37 (human)</lable> </br>
	<input id="hg18" name="buildver" type="radio" value="hg18" /><label for="hg18">hg18/NCBI36 (human) </label> </td> </tr>

<tr> <td> Phenotype to narrow down candidate genes (Optional): </td> 
	<td> 
	<b>Select from pre-compiled list of phenotypes: </b></br>
	<ol><input id="cancer" name="cancer" type="checkbox"> <label for="cancer"> Cancer (488 genes)</label> </br>
	<input id="blindness" name="blindness" type="checkbox"> <label for="blindness">Blindness (79 genes) </label></br>
	<input id="deafness" name="deafness" type="checkbox"> <label for="deafness">Deafness (154 genes)</label> </br>
	<input id="anemia" name="anemia" type="checkbox"> <label for="anemia">Anemia (66 genes) </label></br>
	<input id="intellectual-disability" name="intellectualdisability" type="checkbox"> 
	 <label for="intellectual-disability">Intellectual Disability (176 genes)</label> </br></ol>
	<b>Input comma-delimited phenotype terms: </b></br>
	<textarea name="userphen" cols=50 rows=4></textarea> </td> </tr>
<tr> <td> Comma- or space-delimited list of candidate genes (Optional): </td> <td> <textarea name="usergene" cols=50 rows=4></textarea> </td> </tr>
</table>

<input type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" name="ip" />
<input type='hidden' value='<?php echo GetHostByAddr($_SERVER['REMOTE_ADDR']); ?>' name='host'>

<p><input type="submit" value="submit"><input type="reset" value="clear"></p>
</form>

<a action="/cgi-bin/job.cgi" ><button>job monitor</button></a>


<p> Given a list of regions (stored in a BED file), and optionally a list of 
known disease phenotypes, this web server generates a list of candidate genes for a 
given disease phenotype. </p>

<hr>

</body>
</html>
