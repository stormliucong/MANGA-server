<!DOCTYPE html>

<html>
<meta charset="utf-8"> 
	<head>
		<title>Neurocomplex: analyzing your phsychiatric disease genes</title>
        <link href="http://phenolyzer.usc.edu/css/redmond/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" >
	    <link href="http://phenolyzer.usc.edu/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
	    <link href="http://phenolyzer.usc.edu/bootstrap-3.2.0-dist/css/bootstrap-select.min.css" rel="stylesheet">
	    <link href="http://phenolyzer.usc.edu/css/phenolyzer.css" rel="stylesheet" type="text/css" >
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		        <script data-turbolinks-track="true" src="http://phenolyzer.usc.edu/asset/js/turbolinks.js"></script>
                  <script type="text/javascript"  src="http://phenolyzer.usc.edu/jquery-1.11.0.min.js"></script>
	              <script type="text/javascript"  src="http://phenolyzer.usc.edu/bootstrap-3.2.0-dist/js/bootstrap.min.js" ></script>
	              <script data-turbolinks-track="true" src="http://phenolyzer.usc.edu/bootstrap-3.2.0-dist/js/bootstrap-select.min.js"></script>
				<script data-turbolinks-track="true" src="http://phenolyzer.usc.edu/asset/js/vendor/jquery.ui.widget.js"></script>
	<script data-turbolinks-track="true" src="http://phenolyzer.usc.edu.asset/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script data-turbolinks-track="true" src="http://phenolyzer.usc.edu/asset/js/jquery.iframe-transport.js"></script>
    <script data-turbolinks-track="true" src="http://phenolyzer.usc.edu/asset/js/jquery.fileupload.js"></script>
	<script data-turbolinks-track="true" src="http://phenolyzer.usc.edu/asset/js/turbolinks.js"></script>
	<script data-turbolinks-track="true" src="http://phenolyzer.usc.edu/js/form_control_1.js"></script>
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
          <a class="navbar-brand" href="http://phenolyzer.usc.edu/neurocomplex"><p class="title">Neurocomplex<p></a>
		 
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li class="active" ><a href="http://phenolyzer.usc.edu/neurocomplex">Home</a></li>	

          </ul>
		  <div class="navbar-header navbar-right col-md-3" >
		    <a class="title navbar-brand" href="http://genomics.usc.edu"><img src="http://wannovar3.usc.edu/asset/img/logo.png" alt="" style="height:100%;"></a>
		  </div>
        </div><!--/.nav-collapse --> 
	  </div>
    </div>
    
	<div class="jumbotron" id="phenolyzer">
	<div class="container">
	<div class="col-lg-8 col-lg-offset-1" style="">
  <h1>Neurocomplex</h1>
  <p>Neurocomplex is a tool to discover genes for psychiatric diseases.</p> 
  <p><a class="title-button btn btn-danger btn-lg" role="button" href="#getstart">Get Started</a>
  <button class="title-button btn btn-warning btn-lg" data-toggle="modal" data-target="#contact-phenolyzer">Contact</button>
  
  <!-- Modal -->
<div class="modal fade" id="contact-phenolyzer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-title text-primary" id="myModalLabel">Contact Phenolyzer</h4>
      </div>
      <div class="modal-body">
    <h5>  <strong>Neurocomplex</strong> relies on your feedback. Please send an Email if you wish to make a request, a comment, or report a bug. <br>
         Dr. Marcelo P. Coba:<br><br>
Assistant Professor, Psychiatry & the Behavioral Sciences
Zilkha Neurogenetic Institute
Keck School of Medicine of USC
PIBBS Mentor
        <br>Web Site: <a href="http://www.usc.edu/programs/neuroscience/faculty/profile.php?fid=163">http://www.usc.edu/programs/neuroscience/faculty/profile.php?fid=163</a>
        <br>Email: <a href="mailto:coba@usc.edu">coba@usc.edu</a> </li>    	
         <h5>Dr. Kai Wang:<br>
Assistant Professor, Psychiatry and Preventive Medicine; Member, Zilkha Neurogenetic Institute and Norris Comprehensive Cancer Center
        <br>Web Site: <a href="http://genomics.usc.edu/">http://genomics.usc.edu</a>
        <br>Email: <a href="mailto:kaiwang@usc.edu">kaiwang@usc.edu</a> </li>
         <br><br>Hui Yang:<br>
           Graduate Student, Zilkha Neurogenetic Institute, USC Neuroscience Graduate Program        
        <br>Web Site: <a href="http://genomics.usc.edu/">http://genomics.usc.edu</a>
        <br>Email: <a href="mailto:yanghui@usc.edu">yanghui@usc.edu</a> </li></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> <!-- Modal End-->

  </p></div></div></div>
  
		<div class="container">
		<div class="phenolyzer-content col-lg-8 col-lg-offset-1">
   	    <form action="/cgi-bin/loh.cgi" method="post" ENCTYPE="multipart/form-data" role="form" class="form-horizontal" >
     	<h3 class="text-primary page-header">Input</h3>
     	<div class="well">
		<div class="form-group ">
        <label for="email" class="col-md-3 control-label">Email</label>
        <div class="col-md-5">
        <input  type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
	     </div>
	      
            <div class="form-group">
               <label title="" for="region_selection" class="col-md-3 control-label">Diseases  </label>
               <div class="col-md-5">
                <select class="selectpicker show-menu-arrow " name="disease" id="disease_select">
	           <option  selected value="schizophrenia" >Schizophrenia</option>
	           
	           </select>
                </div> </div>
               
                <div class="form-group" id="region_selection_coba">
    <label class="col-md-3 control-label bedfile">GWAS loci/region <a id="bed_instruction" href="https://genome.ucsc.edu/FAQ/FAQformat.html#format1" target="_blank">(Input Bed File)</a></label>
	<div class="col-sm-9">
	       <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                         <span class="glyphicon glyphicon-plus"></span> Bed File
						 <input type="file" name="bedfile" id="bedfile">
                    </span>
                </span>
                <input type="text" class="form-control" readonly>
            </div>
	 </div></div>
	 
	     
	     <div class="form-group" id="gene_selection_coba">
                  <label title="" class="col-md-3 control-label" >Enter your genes here</label>
	   <div class="col-md-9">
	   <textarea  title="" class="form-control" name="genelist" id="genelist" rows="4" placeholder="please paste your gene list here."></textarea> 
	   <span class="help-block">Please separate genes by semicolon or enter. Entrez IDs are also accepted here.</span>
            </div> </div> 
            <input type="hidden" name="region_selection" value="yes" />
            <input type="hidden" name="gene_selection" value="yes" />   
                
               
      
	
	   <div class="form-group">
	  <label class="col-md-3 control-label" > </label>
	   <div class="col-md-8">
	  <button type="submit" class="btn btn-info ">
	  <span class="glyphicon glyphicon-send"></span> Submit</button>
      <button type="reset" class="btn btn-success ">
	  <span class="glyphicon glyphicon-repeat"></span> Reset</button>
	   </div></div>      </div>
                 
              
	   

           
                
                  <input type='hidden' value='yes' name='coba' />
                 <input type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" name="ip" />
                 <input type='hidden' value='<?php echo GetHostByAddr($_SERVER['REMOTE_ADDR']); ?>' name='host' />
                
                    </form> 
          
	 </div>
	  <div class="wannovar-news col-md-3 " id="news">
	   <h3 class="page-header text-primary"> Recent Updates</h3>
	   <div class="panel panel-default">
           <div class="panel-body">
    		<p><strong>[08/19/2014]</strong> <p>Neurocomplex </p>
			<p> Neurocomplex website available now!</p></div></div>
      </div>  </div>
		<!-- container -->
            <div class="container">
     <div class="footer col-lg-offset-1">
     <p class="text-muted">@Dr.Marcelo Coba, Zilkha Neurogenetic Institute</p>
      </div></div>    
                
                 
               
               
                 
                 
             
	</body>
</html>