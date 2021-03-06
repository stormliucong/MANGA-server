<!DOCTYPE html>
<html>
   <meta charset="utf-8">
   <meta property="og:type" content="website />" 
   <meta property="og:image" content="/img/cancer.png">
   <meta property="og:title" content="Phenolyzer: Phenotype-based gene analyzer">
   <meta property="og:description" content="Phenolyzer stands for Phenotype Based Gene Analyzer, a tool focusing on discovering genes based on user-specific
      disease/phenotype terms.">
   <head>
      <base href="http://localhost">
      <link rel="icon" type="image/x-icon" href="/img/phenolyzer_logo.png" />
      <title>Phenolyzer: Phenotype based gene analyzer</title>
      <link href="/css/redmond/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css">
      <link href="/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="/bootstrap-3.2.0-dist/css/bootstrap-select.min.css" rel="stylesheet">
      <link href="/css/phenolyzer.css" rel="stylesheet" type="text/css">
      <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      <script data-turbolinks-track="true" src="asset/js/turbolinks.js"></script>
      <script type="text/javascript" src="/jquery-1.11.0.min.js"></script>
      <script type="text/javascript" src="/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
      <script data-turbolinks-track="true" src="/bootstrap-3.2.0-dist/js/bootstrap-select.min.js"></script>
      <script data-turbolinks-track="true" src="/asset/js/vendor/jquery.ui.widget.js"></script>
      <script data-turbolinks-track="true" src="/asset/js/jquery-ui-1.10.4.custom.min.js"></script>
      <script data-turbolinks-track="true" src="/asset/js/jquery.iframe-transport.js"></script>
      <script data-turbolinks-track="true" src="/asset/js/jquery.fileupload.js"></script>
      <script data-turbolinks-track="true" src="/asset/js/turbolinks.js"></script>
      <script data-turbolinks-track="true" src="/js/form_control_1.js"></script>
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
               <a class="navbar-brand" style="padding:3px" href="/index.php">
               <img src="../img/phenolyzer.png" style="height:100%"></a>
            </div>
            <div class="collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="active"><a href="/index.php">Home</a></li>
                  <li><a href="/download.php">Download</a></li>
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
               <div class="navbar-header navbar-right col-md-3">
                  <a class="title navbar-brand" href="http://wglab.org" style="padding:5px"><img src="/img/WGL_long.png" alt="" style="height:100%;"></a>
               </div>
            </div>
            <!--/.nav-collapse -->
         </div>
      </div>
      <div class="jumbotron" id="phenolyzer">
         <div class="container">
            <div class="col-lg-8 col-lg-offset-1" style="">
               <h1>Phenolyzer</h1>
               <p>Phenolyzer stands for Phenotype Based Gene Analyzer, a tool focusing on discovering genes based on user-specific disease/phenotype terms. </p>
               <p><a class="title-button btn btn-danger btn-lg" role="button" href="#getstart">Get Started</a>
                  <button class="title-button btn btn-info btn-lg" data-toggle="modal" data-target="#contact-phenolyzer">Contact</button>
                  <a class="title-button btn btn-warning btn-lg" data-toggle="modal" href="/cgi-bin/phenohub.cgi">Post result</a>
                  <br>
               <div class="fb-like" data-share="true" data-width="450" data-show-faces="false">
               </div>
               <!-- Modal -->
               <div class="modal fade" id="contact-phenolyzer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                           <h4 class="modal-title text-primary" id="myModalLabel">Contact Phenolyzer</h4>
                        </div>
                        <div class="modal-body">
                           <h5><strong>Phenolyzer</strong> relies on your feedback. Please send an Email if you wish to make a request, a comment, or report a bug.</h5>
                           <h5>Dr. Kai Wang:<br>Associate Professor, Columbia University
                              <br>Web Site: <a href="http://wglab.org/">http://wglab.org</a>
                              <br>Email: <a href="mailto:kaichop@gmail.com">kaichop@gmail.com</a> </li>
                              <br><br>Hui Yang:<br>
                              Graduate Student, Zilkha Neurogenetic Institute, USC Neuroscience Graduate Program        
                              <br>Web Site: <a href="http://wglab.org/">http://wglab.org</a>
                              <br>Email: <a href="mailto:yanghui@usc.edu">yanghui@usc.edu</a> </li>
                           </h5>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Modal End-->
               </p>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="phenolyzer-content col-lg-8 col-lg-offset-1">
            <form action="" method="post" ENCTYPE="multipart/form-data" role="form" class="form-horizontal">
               <h3 id="getstart" class="page-header text-primary">Basic Information</h3>
               <!-- email form -->
               <div class="form-group">
                  <label for="email" class="col-md-3 control-label">Email</label>
                  <div class="col-md-9">
                     <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                  </div>
               </div>
               <!-- panel head -->
               <div id="tab-panels">
                  <ul class="nav nav-tabs col-md-12">
                     <li class="active">
                        <a href="#pheno-tab" data-toggle="tab">Phenotypes</a>
                     </li>
                     <li>
                        <a href="#ehr-tab" data-toggle="tab">EHR</a>
                     </li>
                  </ul>
               </div>
               <!-- panel body for phenotype input or clinical notes input -->
               <div class="tab-content ">
                  <!-- pheno tab -->
                  <div class="tab-pane active" id="pheno-tab">
                     <div class="form-group">
                        <label title="" class="col-md-3 control-label disease">Diseases/Phenotypes</label>
                        <div class="col-md-9">
                           <textarea title="" class="form-control" name="disease" id="disease" rows="4" placeholder="please enter your focused disease/phenotype terms"></textarea>
                           <span class="help-block">Please use semicolon or enter as separators. Like "alzheimer;brain".
                           <br> Try to use multiple terms instead of a super long term<br>OMIM IDs are also accepted, like 114480 for 'Breast cancer'<br>Please enter 'HP:0002459;HP:0010522;HP:0001662' as HPO IDs.
                           </span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label"> </label>
                        <div class="col-md-8">
                           <!-- change it to form action for this button -->
                           <button type="submit" class="btn btn-info" name="submit-disease" formaction="/cgi-bin/loh.cgi">
                           <span class="glyphicon glyphicon-send"></span> Submit</button>
                           <button type="button" id="translate" class="btn btn-primary translate" data-toggle="tooltip" data-placement="top" title="Translate Chinese disease/phenotypes into English">
                           <span class="glyphicon glyphicon-globe"></span> Translate</button>
                           <button type="reset" class="btn btn-success ">
                           <span class="glyphicon glyphicon-repeat"></span> Reset</button>
                        </div>
                     </div>
                  </div>
                  <!-- ehr tab -->
                  <div class="tab-pane " id="ehr-tab">
                     <div class="form-group">
                        <label title="" class="col-md-3 control-label ehr">EHR Clinical Notes</label>
                        <div class="col-md-9">
                           <textarea title="" class="form-control" name="ehr-text" id="ehr-text" rows="10" placeholder="(Example:) she experiences constant paresthesia and numbness in her extremities. Diminished light touch sensation in her hands and feet make it difficult for her to distinguish textures. She also experiences proximal muscle weakness. She has lost position sense in her distal interphalangeal joints in both her hands and feet. Deep tendon reflexes are absent in her ankles, knees, and wrists."></textarea>
                           <span class="help-block">Please enter free text clinical notes. 
                           </span>
                        </div>
                     </div>
                     <!-- file upload -->
                     <div class="form-group">
                        <label title="" class="col-md-3 control-label ehr">Upload EHR file</label>
                        <div class="col-sm-9">
                           <div class="input-group">
                              <span class="input-group-btn">
                              <span class="btn btn-primary btn-file">
                              <span class="glyphicon glyphicon-plus"></span> EHR.txt
                              <input type="file" name="ehr-file" id="ehr-file">
                              </span>
                              </span>
                              <input type="text" class="form-control" readonly>
                           </div>
                           <span class="help-block">The EHR file will be deleted immediately in the serve. The transfering process is encryted.
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label" > </label>
                        <div class="col-md-8">
                           <!-- change it to form action for this button -->
                           <button type="submit" class="btn btn-info" name="submit-ehr" formaction="/cgi-bin/ehr.cgi">
                           <span class="glyphicon glyphicon-send"></span> Submit</button>
                           <button type="reset" class="btn btn-success ">
                           <span class="glyphicon glyphicon-repeat"></span> Reset</button>
                        </div>
                     </div>
                  </div>
               </div>
               <h3 class="page-header text-primary">Options</h3>
               <!-- gene selection form-->
               <div class="form-group">
                  <label title="" for="gene_selection" class="col-md-3 control-label gene_selection_options">Gene Selection </label>
                  <div class="col-md-5">
                     <select class="selectpicker show-menu-arrow " name="gene_selection" id="gene_selection_options">
                        <option selected value="no">No</option>
                        <option value="yes">Yes</option>
                     </select>
                  </div>
                  <div class="col-md-3">
                     <button type="button" class="btn btn-info btn-sm" data-toggle="popover" title="Gene Selection" , data-content="Turn on the Gene Selection to input your own genelist instead of conducting a genome-wide prioritization? You can use your gene list 
                        generated from wANNOVAR! Is that amazing?">
                     <span class="glyphicon glyphicon-th-list"></span></button>
                  </div>
               </div>
               <div class="form-group" id="gene_selection">
                  <label title="" class="col-md-3 control-label">Enter your genes here</label>
                  <div class="col-md-9">
                     <textarea title="" class="form-control" name="genelist" id="genelist" rows="4" placeholder="please paste your gene list here."></textarea>
                     <span class="help-block">Please separate genes by semicolon or enter. Entrez IDs are also accepted here.</span>
                  </div>
               </div>
               <div class="form-group">
                  <label title="" for="region_selection" class="col-md-3 control-label region_selection_options">Region Selection </label>
                  <div class="col-md-5">
                     <select class="selectpicker show-menu-arrow " name="region_selection" id="region_selection_options">
                        <option selected value="no">No</option>
                        <option value="yes">Yes</option>
                     </select>
                  </div>
                  <div class="col-md-3">
                     <button type="button" class="btn btn-info btn-sm" data-toggle="popover" title="Region Selection" , data-content="Turn on the Region Selection to upload your focusing genomic regions. You can use your bed file called from a CNV calling Pipeline! Is that amazing?">
                     <span class="glyphicon glyphicon-th-list"></span></button>
                  </div>
               </div>
               <div id="region_selection">
                  <div class="form-group">
                     <label class="col-md-3 control-label bedfile"> <a id="bed_instruction" href="https://genome.ucsc.edu/FAQ/FAQformat.html#format1" target="_blank">Input Bed File</a></label>
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
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="buildver" class="col-md-3 control-label">Reference Genome</label>
                     <div class="col-md-5">
                        <select class="selectpicker show-menu-arrow   k" name="buildver" id="buildver" style="display: none;">
                           <option selected="" value="hg19">hg19</option>
                           <option value="hg18">hg18</option>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="popover" title="" ,="" data-content="Neurocomplex currently supports hg18 and hg19 genome build. " data-original-title="Reference Genome">
                        <span class="glyphicon glyphicon-th-list"></span></button>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="other_options" title="" class="col-md-3 control-label advanced_options">Phenotype Interpret </label>
                  <div class="col-md-5">
                     <select class="selectpicker show-menu-arrow" title="" name="other_options" id="other_options">
                        <option selected value="phenotype_interpretation">Phenotype Interpretation</option>
                        <option value="none">Disease Only</option>
                        <!--option value="all_diseases" >Select all diseases</option-->
                     </select>
                  </div>
                  <div class="col-md-3">
                     <button type="button" class="btn btn-info btn-sm" data-toggle="popover" title="Advanced Options" , data-html="true" data-content="<b>Phenotype interpretation:</b> Interpret phenotype terms into disease names<br>
                        <b>Disease Only:</b> Terms are treated only as disease terms<br>
                        <!--b>All diseases:</b> Terms neglected, all diseases in database used" -->
                     <span class="glyphicon glyphicon-th-list"></span></button>
                  </div>
               </div>
               <div class="form-group">
                  <label title="" for="weight_adjust_options" class="col-md-3 control-label weight_adjust_options">Weight Adjust </label>
                  <div class="col-md-5">
                     <select class="selectpicker show-menu-arrow " name="weight_adjust" id="weight_adjust_options">
                        <option selected value="no">No</option>
                        <option value="yes">Yes</option>
                     </select>
                  </div>
                  <div class="col-md-3">
                     <button type="button" class="btn btn-info btn-sm" data-toggle="popover" title="Weight Adjust" , data-content="You can adjust the weights of each data source. Attention, if you turn this on, the weights below are different
                        from the default weights!!!You can even turn a database out by setting the weight as 0. Is this amazing?">
                     <span class="glyphicon glyphicon-th-list"></span></button>
                  </div>
               </div>
               <div id="weight_adjust" class="col-lg-12">
                  <br>
                  <br>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label " class="col-md-5 control-label ">GWAS</label>
                        <div class="col-md-7 ">
                           <input type="text " class="form-control text-form " id="GWAS " name="GWAS " value="1 ">
                        </div>
                     </div>
                     <div class="form-group ">
                        <label class="col-md-5 control-label ">OMIM</label>
                        <div class="col-md-7 ">
                           <input type="text " class="form-control text-form " id="OMIM " name="OMIM " value="1 ">
                        </div>
                     </div>
                     <div class="form-group ">
                        <label class="col-md-5 control-label ">ClinVar</label>
                        <div class="col-md-7 ">
                           <input type="text " class="form-control text-form " id="CLINVAR " name="CLINVAR " value="1 ">
                        </div>
                     </div>
                     <div class="form-group ">
                        <label class="col-md-5 control-label ">Orphanet</label>
                        <div class="col-md-7 ">
                           <input type="text " class="form-control text-form " id="ORPHANET " name="ORPHANET " value="1 ">
                        </div>
                     </div>
                     <div class="form-group ">
                        <label class="col-md-5 control-label "> Gene Reviews</label>
                        <div class="col-md-7 ">
                           <input type="text " class="form-control text-form " id="GENE_REVIEWS " name="GENE_REVIEWS " value="1 ">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 ">
                     <div class="form-group ">
                        <label class="col-md-5 control-label ">HPRD</label>
                        <div class="col-md-7 ">
                           <input type="text " class="form-control text-form " id="HPRD " name="HPRD " value="0.1 ">
                        </div>
                     </div>
                     <div class="form-group ">
                        <label class="col-md-5 control-label ">Biosystem</label>
                        <div class="col-md-7 ">
                           <input type="text " class="form-control text-form " id="BIOSYSTEM " name="BIOSYSTEM " value="0.05 ">
                        </div>
                     </div>
                     <div class="form-group ">
                        <label class="col-md-5 control-label ">Gene Family</label>
                        <div class="col-md-7 ">
                           <input type="text " class="form-control text-form " id="HGNC " name="HGNC " value="0.05 ">
                        </div>
                     </div>
                     <div class="form-group ">
                        <label class="col-md-5 control-label ">HTRI</label>
                        <div class="col-md-7 ">
                           <input type="text " class="form-control text-form " id="HTRI " name="HTRI " value="0.05 ">
                        </div>
                     </div>
                  </div>
               </div>
               <!-- <div class="form-group ">
                  <label title=" " for="wordcloud " class="col-md-3 control-label wordcloud ">Word Cloud  </label>
                  <div class="col-md-5 ">
                     <select class="selectpicker show-menu-arrow " name="wordcloud " id="wordcloud ">
                        <option selected value="no " >No</option>
                        <option value="yes "  >Yes</option>
                     </select>
                  </div>
                  <div class="col-md-3 ">
                     <button type="button " class="btn btn-info btn-sm " data-toggle="popover "
                        title="Word Clouod ",
                        data-content="Choose yes if you want to see the Word Cloud of your phenotype/disease. Is this amazing? ">
                     <span class="glyphicon glyphicon-th-list "></span></button>
                  </div>
               </div> -->
               <h3 class="page-header text-primary ">Addon Databases</h3>
               <!-- Addon -->
               <div class="form-group ">
                  <label for="step " class="col-md-3 control-label ">Addon Seed Gene</label>
                  <div class="col-md-7 ">
                     <select class="selectpicker show-tick "  multiple name="addon_seed " id="addon_seed " data-selected-text-format="count>1">
                        <option value="DB_DISGENET_GENE_DISEASE_SCORE">DisGenet Disease Gene Mapping</option>
                        <option value="DB_GAD_GENE_DISEASE_SCORE">Genetic Association Database</option>
                        <!-- option  value="DB_GENECARDS_GENE_DISEASE_SCORE">GeneCards Gene Disease Association</option -->
                        <option value="DB_IGA_NEPHROPATHY">Extra genes for Iga nephropathy (Thanks to Xuewen Song)</option>
                        <option value="DB_CHD_YUFENG_EXPANSION"> (For test use only) CHD </option>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label for="step" class="col-md-3 control-label">Addon Gene Relations</label>
                  <div class="col-md-7">
                     <select class="selectpicker show-tick" multiple name="addon" id="addon" data-selected-text-format="count>1">
                        <option value="DB_MENTHA_GENE_GENE_INTERACTION">Mentha Protein Interaction Database</option>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label for="step" class="col-md-3 control-label">Addon Gene Scores</label>
                  <div class="col-md-7">
                     <select class="selectpicker show-tick" multiple name="gene_score" id="gene_score" data-selected-text-format="count>1">
                        <option value="haploinsufficiency">Gene Haploinsufficiency Score</option>
                        <option value="intolerance">Gene Intolerance Score</option>
                     </select>
                  </div>
               </div>
               <!-- End of Addon -->
               <h3 class="page-header text-primary">Reference</h3>
               <div class="col-md-12">
                  <p>Yang, Hui, Peter N. Robinson, and Kai Wang.
                     <a href="http://www.nature.com/nmeth/journal/v12/n9/abs/nmeth.3484.html">Phenolyzer: phenotype-based prioritization of candidate genes for human diseases. Nature Methods (2015).
                     </a>
                  </p>
               </div>
               <input type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" name="ip" />
               <input type="hidden" value="<?php echo GetHostByAddr($_SERVER['REMOTE_ADDR']); ?>" name='host'>
            </form>
         </div>
         <div class="wannovar-news col-md-3 " id="news">
            <h3 class="page-header text-primary"> Recent Updates</h3>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[03/30/2017]</strong></p>
                  <p>OMIM database is updated
                  </p>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[02/07/2017]</strong></p>
                  <p>Phenolyzer webserver is being migrated! You may experience page loading problems and other issues.
                  </p>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[08/04/2016]</strong></p>
                  <p>OMIM database is now updated to 2016-08-04 version!
                  </p>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[01/24/2016]</strong></p>
                  <p>OMIM database is now updated to 2016-01-24 version!
                  </p>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[01/05/2016]</strong></p>
                  <p>Due to copyright issues, GeneCards database is no longer provided in Phenolyzer.
                  </p>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[12/02/2015]</strong></p>
                  <p>Dear all, you might have experienced some changes in your result. Don't panic! There's been several big updates in <b>NCBI's Biosystem 
                     database</b>. We recently noticed it and updated the database in Phenolyzer! Toast!
                  </p>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[11/19/2015]</strong></p>
                  <p>1) OMIM database was updated to 2015-11-19
                  <p>2) We added a functionality <b class="text-danger">specifically for Chinese</b>, now you can entern chinese and click 'Translate' to translate your disease into English!
                  </p>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[11/17/2015]</strong></p>
                  <p> OMIM database was updated again.
                  </p>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[08/06/2015]</strong></p>
                  <p> Now the HPO Identifiers are supported. For example, please enter 'HP:0002459; HP:0010522; HP:0001662'.</p>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[06/19/2015]</strong></p>
                  <p> The HPO ontology and anotation, DO ontology, and OMIM disease synonyms are updated to the newest version!
                  </p>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[05/15/2015]</strong></p>
                  <p> The OMIM,GWAS Catalog, ClinVar databases are updated to the newest version!
                  </p>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[05/01/2015]</strong></p>
                  <p> Two additional gene scores were added into Phenolyzer as annotations:
                     <b><a href="http://journals.plos.org/plosgenetics/article?id=10.1371/journal.pgen.1001154">Gene Haploinsufficiency Score</a></b> for dominant disease genes, and
                     <b><a href="http://journals.plos.org/plosgenetics/article?id=10.1371/journal.pgen.1003709">Gene Intolerance Score</a></b> for severe disease genes
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-body">
                  <p><strong>[10/21/2014]</strong></p>
                  <p>Several important databases are integrated as the form of plugins: <b class="text-info">Mentha protein-protein interaction database</b> for gene-gene mapping, , <b class="text-info">DisGenet gene-disease database</b>, <b class="text-info">Genetic Association Database</b>, <b class="text-info">GeneCards</b> for disease-gene mapping!
                     <br>
                     <br>
                  </p>
               </div>
            </div>
         </div>
      </div>
      <!-- container -->
      <div class="container">
         <div class="footer col-lg-offset-1">
            <p class="text-muted">
               All Rights Reserved @Wang Genomics Lab 2010-
               <script type="text/javascript">
                  document.write(new Date().getFullYear());
               </script>
            </p>
         </div>
      </div>
   </body>
   <script>
      (function(i, s, o, g, r, a, m) {
          i['GoogleAnalyticsObject'] = r;
          i[r] = i[r] || function() {
              (i[r].q = i[r].q || []).push(arguments)
          }, i[r].l = 1 * new Date();
          a = s.createElement(o),
              m = s.getElementsByTagName(o)[0];
          a.async = 1;
          a.src = g;
          m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
      
      ga('create', 'UA-56057397-1', 'auto');
      ga('send', 'pageview');
   </script>
   <script>
      window.fbAsyncInit = function() {
          FB.init({
              appId: '642011455939272',
              xfbml: true,
              version: 'v2.5'
          });
      };
      
      (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) {
              return;
          }
          js = d.createElement(s);
          js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js";
          fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
   </script>
   
});
</html>