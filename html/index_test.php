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
        <link href="./css/redmond/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" >
	    <link href="./bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
	    <link href="./bootstrap-3.2.0-dist/css/bootstrap-select.min.css" rel="stylesheet">
	    <link href="./css/phenolyzer.css" rel="stylesheet" type="text/css" >
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		        <script data-turbolinks-track="true" src="asset/js/turbolinks.js"></script>
                  <script type="text/javascript"  src="./jquery-1.11.0.min.js"></script>
	              <script type="text/javascript"  src="./bootstrap-3.2.0-dist/js/bootstrap.min.js" ></script>
	              <script data-turbolinks-track="true" src="./bootstrap-3.2.0-dist/js/bootstrap-select.min.js"></script>
				<script data-turbolinks-track="true" src="asset/js/vendor/jquery.ui.widget.js"></script>
	<script data-turbolinks-track="true" src="asset/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script data-turbolinks-track="true" src="asset/js/jquery.iframe-transport.js"></script>
    <script data-turbolinks-track="true" src="asset/js/jquery.fileupload.js"></script>
	<script data-turbolinks-track="true" src="asset/js/turbolinks.js"></script>
	<script data-turbolinks-track="true" src="js/form_control_1.js"></script>



	</head>
	<body>
  <div class="container">
    <div class="phenolyzer-content col-lg-8 col-lg-offset-1">
      <form action="" method="post" ENCTYPE="multipart/form-data" role="form" class="form-horizontal" >
        
        <h3 id="getstart" class="page-header text-primary">Basic Information</h3>  
        
        <!-- email form -->
        <div class="form-group">
          <label for="email" class="col-md-3 control-label">Email</label>
          <div class="col-md-9">
            <input  type="email" required  class="form-control" id="email" name="email" placeholder="Email">
          </div>
        </div>
        

        <!-- panel head -->
        <div id="tab-panels">
          <ul class="nav nav-tabs col-md-12">
            <li class="active">
              <a  href="#pheno-tab" data-toggle="tab">Phenotypes</a>
            </li>
            <li>
              <a  href="#ehr-tab" data-toggle="tab">EHR</a>
            </li>
          </ul>
        </div>

        <!-- panel body for phenotype input or clinical notes input -->
        <div class="tab-content ">
          <!-- pheno tab -->
          <div class="tab-pane active" id="pheno-tab">
            <!-- disease textbox -->
            <div class="form-group">
              <label title="" class="col-md-3 control-label disease" >Diseases/Phenotypes</label>
              <div class="col-md-9">
                <textarea  required title="" class="form-control" name="disease" id="disease" rows="4" placeholder="please enter your focused disease/phenotype terms"></textarea>
                <span class="help-block">Please use semicolon or enter as separators. Like "alzheimer;brain".
                  <br> Try to use multiple terms instead of a super long term<br>OMIM IDs are also accepted, like 114480 for 'Breast cancer'<br>Please enter 'HP:0002459;HP:0010522;HP:0001662' as HPO IDs.
                </span>
              </div>
            </div>

            <!-- buttons -->
            <div class="form-group">
              <label class="col-md-3 control-label" > </label>
              <div class="col-md-8">
                <!-- change it to form action for this button -->
                <button type="submit" class="btn btn-info" name="submit-disease" formaction="/cgi-bin/abc.cgi"><span class="glyphicon glyphicon-send"></span> SubmitA</button>

                <button type="button" id="translate" class="btn btn-primary translate"
                 data-toggle="tooltip" data-placement="top" title="Translate Chinese disease/phenotypes into English"><span class="glyphicon glyphicon-globe"></span> Translate</button>

                <button type="reset" class="btn btn-success "><span class="glyphicon glyphicon-repeat"></span> Reset</button>
              </div>
            </div>

          </div>

          <!-- ehr tab -->
          <div class="tab-pane " id="ehr-tab">
            <!-- EHR BOX -->
            <div class="form-group">
              <label title="" class="col-md-3 control-label ehr" >EHR Clinical Notes</label>
              <div class="col-md-9">
                <textarea  required title="" class="form-control" name="ehr-text" id="ehr-text" rows="10" placeholder="(Example:) she experiences constant paresthesia and numbness in her extremities. Diminished light touch sensation in her hands and feet make it difficult for her to distinguish textures. She also experiences proximal muscle weakness. She has lost position sense in her distal interphalangeal joints in both her hands and feet. Deep tendon reflexes are absent in her ankles, knees, and wrists. She has hyperesthesia of her lower legs, particularly of the soles of her feet. She also has atrophy of the fat pads of her face and has experienced neuropathic pain in her hands and feet. She has an ataxic gait and has reduced hearing in her left ear (512 mHz). Her parents and two siblings showed no signs of sharing her phenotype."></textarea><span class="help-block">Please enter free text clinical notes or upload a .txt file.
                </span>
              </div>
            </div>
            <div class="form-group">
              <!-- change it to form action for this button -->
              <button type="submit" class="btn btn-info" name="submit-ehr" formaction="/cgi-bin/ehr.cgi">
                <span class="glyphicon glyphicon-send"></span> SubmitB</button>
            </div>
          </div>
        </div>  
                 
        <h3 class="page-header text-primary">Options</h3> 
        
      </form>
    </div>
	</div>
            
	</body>
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56057397-1', 'auto');
  ga('send', 'pageview');

</script>
	<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '642011455939272',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  
</script>

	

</html>
