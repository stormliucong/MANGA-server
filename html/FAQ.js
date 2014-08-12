
     $(document).ready(function(){
       //accordion
    	 
    	 var result_panel = $("#Faq-accordion");
         
    	 result_panel.accordion(
                		   { header: "h3.Faq",
                			 heightStyle: "content", 
                		    collapsible: true ,
                		    active: null,
                		    icons:{ "header": "ui-icon-plus", "activeHeader": "ui-icon-minus" }
                		   });     
   
        
     
     });