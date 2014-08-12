       
                $(window).load(function()    {
        	       $( "#dialog" ).dialog("close");
        	       $('.wrapper').fadeTo(1000,1);
        	       var interaction =  $("tr.related_interaction");
                   var detail =       $("tr.related_disease");
                   var detail_check     =  $("h3#show_detail");
                   var prediction_check =  $("h3#show_prediction");
                   var result_panel     =  $("#accordion"); 
                   
                   var disease_off = $('#disease_off');   
                   var gene_off = $('#gene_off'); 
                   var disease_names_on = $("#show_disease_names");
                   var gene_names_on = $("#show_gene_names");
                   var save_photo = $('#save_photo');
                   
                   interaction.hide();
                   detail.hide();
                   $("a.outside").attr("target","_blank");
                 
                   var change_text = $("h3#barplot a");
                 //  change_text.css('color','#7777fa')
                  
                   
                   //accordion
                   result_panel.accordion(
                		   { header: "h3.gene_score",
                			 heightStyle: "content", 
                		    collapsible: true ,
                		    active: null });     

                   //The gene-disease network
                     
                     var if_json_success;
                     var json_url = document.URL;
                     var id = json_url.match(/#(\d+)/);
                      if(id && $(id[0]) ) $(id[0]).click();
             
                      json_url = json_url.replace(/index.html.*/,"");
                      json_url +=  "network.json";
                	  var json;
                	  $.ajaxSetup({'async': false} );
                	  $.getJSON(json_url, function(data){
                		 json = data;
                		 if_json_success = true;
                        }).fail(function( jqxhr, textStatus, error ) {
                           $('#cy').remove();
                           $('#network_control').remove();
                           $('label.result').remove();                         
                           $('#save_photo').remove();
                           $('#show_edges').remove();
                           alert("Sorry, the fancy network plot is not available now.");
                           if_json_success = false;
                        });
   if(if_json_success)
	   {
                	   $('#cy').cytoscape({
                	     style: cytoscape.stylesheet()
                	       .selector('node')
                	         .css({
                	           'content': 'data(id)',
                	           'text-valign': 'center',
                	   		   'font-size':'mapData(weight, 0, 1, 18px, 22px)',
                	           'color': 'white',
                	           'text-outline-width': 'mapData(weight, 0, 0.5, 4px, 3px)',
                	          
                	          
                	         })
                	       .selector('edge')
                	         .css({
                  	           'target-arrow-shape': 'none',
                  	         
                  	           'width':'0.5px',
                  	           //'curve-style':'bezier'
                	         })
                	         .selector('edge.BIOSYSTEM')
                	         .css({
                	           'line-color':"mapData(weight,0.2,0.8, #eeee55, #dddd11)"
                	           
                	         })
                	         .selector('edge.HPRD')
                	         .css({
                	           'line-color':"mapData(weight,0.2,0.8, #5555ff, #4444dd)"
                	         })
                	         .selector('edge.GENE_FAMILY')
                	         .css({
                	    	    'line-color':'#00ef33'
                	         })
                	         .selector('edge.HTRI')
                	         .css({
                	        	'line-color':'#020202' ,
                	        	 'target-arrow-shape': 'triangle',
                	        	 'target-arrow-color':'#1f1f1f'
                	         })
                	         .selector('edge.disease_term')
                	         .css({
                	           'line-color':"#ef55cc"
                	         })
                	         .selector('edge.disease_gene')
                	         .css({
                	           'line-color':"#ef55cc"
                	         })
                	       .selector(':selected')
                	         .css({
                	           'background-color': 'red',
                	           'line-color': 'red',
                	           'target-arrow-color': 'red',
                	           'source-arrow-color': 'red'
                	         })
                	       .selector('node.Reported')
                	         .css({
                	        	'background-color':'mapData(color_weight,0,1,#0055ff,#003366)',
                	        	'text-outline-color':'mapData(color_weight,0,1,#0077ff,#007766)',
                	        	'border-width':'0px',
                	        	'width': 'mapData(weight, 0,1, 15, 85)',
                 	           'height':'mapData(weight, 0,1, 15, 85)',
                	        	
                	         })
                	        .selector('node.Predicted')
                	        .css({
                	        	'background-color':'mapData(color_weight,0,1, #CCCC00, #666600)',
                	        	'text-outline-color': 'mapData(color_weight, 0, 1, #CCCC00, #666600)',
                	        	'border-width':'0px',
                	        	'width': 'mapData(weight, 0,1, 15, 85)',
                 	           'height':'mapData(weight, 0,1, 15, 85)',
                	        	
                	        })
                	        .selector('node.disease')
                	        .css({
                	        	'text-outline-width':'2px',
                	        	'text-outline-color':'mapData(weight,0,1,#FF33CC ,#FF0066)',
                	        	'content':'',
                	        	'shape':'roundrectangle',
                	        	'background-color':'mapData(weight,0,1,#FF33CC,#FF0066)',
                	        	'width':'mapData(weight, 0, 1, 18, 90)',
                	        	'height':'20',
                	        	'font-size':'10px'
                	        })
                	        .selector('node.term')
                	        .css({
                	        	'text-outline-width':'3px',
                	        	'text-outline-color':'#FF33CC',
                	        	'background-color':'#f0f000',
                	        	'font-size':'35px',
                	        	'shape':'star',
                	        	'width':'18px',
                	        	'height':'18px'
                	        	
                	        	
      
                	        })
                	       .selector('.highlighted')
                	         .css({
                	          'background-color': '#ff0303',
                	   	     'line-color': '#ff0303',
                	   	     'text-outline-color':'#ff0303',
                             'target-arrow-color': '#ff0303',
                	         'source-arrow-color': '#ff0303',
                	      
                	         })
                	         .selector('.faded')
                	         .css({
                	        	'opacity':'0'
                	        	 
                	         }),
                	         userZoomingEnabled :true,
                	         panningEnabled : true,
                	         userPanningEnabled: true,
                	
                	        
                	     zoom: 1,
                	     minZoom: 1e-50,
                	     maxZoom: 1e50,
                	     elements: [],
                	     
                	   
                	     
                	     ready: function(){
                	       window.cy = this;
  
                	       // giddy up...
                	       
                	       cy.elements().unselectify();
                	       
                	       cy.on('tap', 'node', function(e){
                	         var node = e.cyTarget; 
                	         var neighborhood = node.neighborhood().add(node);
                	         
                	       //  cy.elements().removeClass('highlighted');
                	        // neighborhood.addClass('highlighted');
                	         cy.elements().addClass('faded');
                	         neighborhood.removeClass('faded');
                	         if( node.hasClass("disease") )
          	        	   {
                	        	 if(disease_names_on.prop('checked')==false) node.css('content','data(id)');
          	        	   }
                	       });
                	       
                	       cy.on('tap', function(e){
                	         if( e.cyTarget === cy ){
                	           //cy.elements().removeClass('highlighted');
                	        	 cy.elements().removeClass('faded');
                	           
                	           if(disease_names_on.prop('checked')==false) cy.elements('node.disease').css('content','');
                                                  }
                	       });
                	     
                	     }
                	                   });
                	var cy = $('#cy').cytoscape('get'); 
                    cy.load(json);
                    cy.boxSelectionEnabled(false);
                   
               //Control Button   
                    $( "#network_control" ).buttonset();
                    $( "#save_photo").button();
                    $( "#tooltips").button();
                   
              //set the initial states of checkboxes  
                    disease_off.prop('checked',false);
                    gene_off.prop('checked',false);
                    gene_names_on.prop('checked',true);
                    disease_names_on.prop('checked',false);
                   disease_off.button("refresh");
                   gene_off.button("refresh");
                   disease_names_on.button("refresh");
                   gene_names_on.button("refresh");
                    var disease_nodes;
                    var gene_nodes;
                    var disease_edges = cy.elements('edge.disease_term');
                    var disease_gene_edges = cy.elements('edge.disease_gene');
                    var gene_edges = cy.elements('edge.gene');
                    var term_nodes;
                    disease_off.change( function(){
                    	if(disease_off.is(":checked") ) {
                    		disease_nodes = cy.elements('node.disease');
                    		term_nodes = cy.elements('node.term');
                    		cy.remove(disease_nodes);
                    		cy.remove(term_nodes);
                    		layout_change(500);
                                              }
                    	else{
                    		cy.add(disease_nodes);
                    		cy.add(term_nodes); 
                    		cy.add(disease_edges);
                    		cy.add(disease_gene_edges);
                    		layout_change(1000);
                    	}
                    });
                    gene_off.change( function(){
                    	if(gene_off.is(":checked") ) {
                    		gene_nodes = cy.elements('node.gene');
                    		cy.remove(gene_nodes);
                            layout_change(500);
                            }
                    	else{
                    		cy.add(gene_nodes);
                    		cy.add(gene_edges);
                    		cy.add(disease_gene_edges);
                    		layout_change(1000);
                              	   }
                    });
                    disease_names_on.change( function(){
                    	if(disease_names_on.is(":checked") ) {
                    		cy.elements('node.disease').css('content','data(id)');
                                                    }
                    	else{
                    		cy.elements('node.disease').css('content','');
                              	   }
                    });
                    
                    gene_names_on.change( function(){
                    	if(gene_names_on.is(":checked") ) {
                    		cy.elements('node.gene').css('content','data(id)');
                                                    }
                    	else{
                    		cy.elements('node.gene').css('content','	');
                              	   }
                                                    });
                    var show_edges = $('#show_edges');
                      show_edges.change( function(){
                    	  if(show_edges.find("option:selected").val()=="all" )
                    		  {
                    		  cy.elements('edge').show();
                    		  }
                    	  if(show_edges.find("option:selected").val()=="HPRD" )
                    		  {
                    		  cy.elements('edge').hide();
                    		  cy.elements('edge.HPRD').show();
                    		  }
                    	  if(show_edges.find("option:selected").val()=="GeneFamily" )
                		     {
                		  cy.elements('edge').hide();
                		  cy.elements('edge.GENE_FAMILY').show();
                		      }
                    	  if(show_edges.find("option:selected").val()=="Biosystem" )
             		     {
             		      cy.elements('edge').hide();
             		      cy.elements('edge.BIOSYSTEM').show();
             		      }
                    	  if(show_edges.find("option:selected").val()=="TranscriptionInteraction")
                          {
                          cy.elements('edge').hide();
                          cy.elements('edge.HTRI').show();
                          }
                      });
	                 
                      $('#save_photo').click( function(){
                      	window.open(cy.png({'bg':'#ffffff'}));
                      });
                      $("#tooltips").click( function(){
                      	window.open("http://phenolyzer.usc.edu/images/network_instruction.png","","height=600px, width=1000px,top=200px, left = 200px");
                      });  
                      
                      var adjust_layout = $('#adjust_layout');
                      function layout_change(time){
                    	  if(adjust_layout.find("option:selected").val()=="force" )
                		  {
                		  cy.layout({                  
                  	    	 name: 'arbor',
                 	    	 stiffness:0,
                 	    	 maxSimulationTime: time
                		  });
                		  }
                	  if(adjust_layout.find("option:selected").val()=="circle" )
                		  {
                		   cy.layout({name: 'circle',
                			   rStepSize: 30});
                		  }
                	  if(adjust_layout.find("option:selected").val()=="grid" )
            		     {
                		  cy.layout({name: 'grid'});
            		      }
                	  if(adjust_layout.find("option:selected").val()=="concentric" )
         		     {
                		  cy.layout({name: 'concentric'});
         		      }
                	
                  };
                      adjust_layout.change({time:1000},function(event){  layout_change(event.data.time);  });
                     cy.layout({                  
             	    	 name: 'arbor',
            	    	 stiffness:0,
            	    	 maxSimulationTime: 1000,
            	    	 
            	     });
                     $('#cy').cytoscapePanzoom({
     					// options go here
     				 });
                    
	                 }   //if(if_json_success)
                    
               });
                   
                 
               
                   
	               