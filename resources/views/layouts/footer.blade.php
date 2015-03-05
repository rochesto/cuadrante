<div>
	<input type="hidden" data-data="{{ $events }}" id="eventos" />
	<input type="hidden" data-data="{{ $turnos }}" id="turnosFooter" />
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" /> 
</div>

<!-- 

	Gestionar Calendario


 -->
<script src='js/es.js'></script>
<script type="text/javascript" >

    $(document).ready(function(){

    	$('.content').on('contextmenu', function(event) {
    		event.preventDefault();
    	});
   
    	/*
    	/
    	/ Variables
		/
    	 */
    	
    	var eventos = $('#eventos').data('data');
    	var turnos = $('#turnosFooter').data('data');


    	 /*
	    /
	    /	Gestion de turnos
	    /
	    /
	     */
	    
	    // Mostrar los turnos
	    jQuery.each(turnos, function(index, val) {

	    	$('#turnosContent').append('<div id="turnoActual" class="external-event draggable" style="background-color:'+val['backgroundColor']+'" data-turno="'+val['title']+'" data-description="'+val['description']+'" data-id="'+ val['id'] +'">'+val['title']+'</div>');

	    }); 


	    $('#turnosContent').append('<div><button><a href="perfil">Editar</a></button></div>');


	   	$('#turnoAddSubmit').on('click', function(event) {
	   		event.preventDefault();

	   		$.ajax({
	        	headers:
			    {
			        'X-CSRF-Token': $('input[name="_token"]').val()
			    },
        		url: 'calendario/turno',
        		type: 'POST',
        		data: { title: $('#turnoAddTitle').val(), description: $('#turnoAddDesc').val(), backgroundColor: $('#turnoAddColor').val(), horas: $('#turnoAddHoras').val() },
        		success: function(res){
        			if(res == 'Ok')
        			{
        				location.reload();
        			}else{

        			}
        		}
        	})
        	.done(function() {
        		console.log("success");
        	})
        	.fail(function() {
        		console.log("error");
        	})
        	.always(function() {
        		console.log("complete");
         	});
	   	});	    

    	/*
	    /
	    / 	Modificar elementos
	    /
	    */

	    $( ".draggable" ).draggable({
	      	revert: true,
    		revertDuration: 0
	    });


	    $("#addEvent").hide();
	    $("#editEvent").hide();

    	//Selecciona los elmentos evento, que seran arrastrados y añadidos a la base de datos
    	function ini_events(ele) {
	        ele.each(function() {

	            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
	            // it doesn't need to have a start or end
	            var eventObject = {
	                title: $.trim($(this).text()) // use the element's text as the event title
	            };

	            // store the Event Object in the DOM element so we can get to it later
	            $(this).data('eventObject', eventObject);

	            // make the event draggable using jQuery UI
	            $(this).draggable({
	                zIndex: 1070,
	                revert: true, // will cause the event to go back to its
	                revertDuration: 0  //  original position after the drag
	            });

	        });
	    }

	    /*
	    /
	    /	Funciones ventana emergente
	    /
	    */

	    //Funcion imprimir error
	    function errorCal(){
	    	$('#errorCal').html('<button class="btn btn-danger disabled"><h4 class=""><i class="fa fa-refresh"></i> Se necesita recargar. Click aquí <i class="fa fa-refresh"></i></h4></button>').css('cursor', 'click').click(function() {
    			location.reload();
			});
	    }

	    ini_events($('#draggable div.draggable'));
	    



	    /*
		/
		/	Gestion del calendario
		/
		/
	    */
       	$('#calendar').fullCalendar({

       		editable: true,
            droppable: true,
            sortable: true,
	        events: eventos,

	        dayClick: function(date){

	        	var title = $("#addEventTitle");

	        	$('#addEvent').dialog({
	        		title: 'Añadir nota. Día: ' + date.format(),

				  	buttons: [
				  	{
				  		text: "Cancelar",
				  		click: function(){
				  			$( this ).dialog( "close" );
				  		}
				  	},
				    {
				      	text: "Guardar",
				      
				      	click: function() {
				        	$( this ).dialog( "close" );

				        	$.ajax({
					        	headers:
							    {
							        'X-CSRF-Token': $('input[name="_token"]').val()
							    },
				        		url: 'calendario/add',
				        		type: 'POST',
				        		data: { title: $('#addEventTitle').val(), description: $('#addEventdesc').val(), start: date.format(),  backgroundColor: $('#addEventcolor').val() },
				        	})
				        	.done(function() {
				        		console.log("success");
				        		location.reload();
				        	})
				        	.fail(function() {
				        		console.log("error");
				        	})
				        	.always(function() {
				        		console.log("complete");
				         	});
				      	},	
				    }
				  ]
				});
	        },

	        drop: function(date, allDay) {


	        	// retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.title = $(this).data('turno');
                copiedEventObject.start = date.format();
                copiedEventObject.allDay = allDay;
                copiedEventObject.backgroundColor = $(this).css("background-color");
                copiedEventObject.borderColor = "black";

		        $.ajax({
		        	headers:
				    {
				        'X-CSRF-Token': $('input[name="_token"]').val()
				    },
	        		url: 'calendario/add',
	        		type: 'POST',
	        		data: {id: $(this).data('id'), title: $(this).data('turno'), description: $(this).data('description'), start: date.format(), backgroundColor: $(this).css("background-color") },
	        		success: function(resultado){
	        				
	        			if(resultado == 'Ok'){
	        				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
	        			}else if(resultado == 'Oka'){
	        				location.reload();
	        			}
	        			else{
	        				errorCal();
	        			}
	        		}
	        	})
	        	.done(function() {
	        		console.log("success");
	        		
	        	})
	        	.fail(function() {
	        		console.log("error");
	        	})
	        	.always(function() {
	        		console.log("complete");
	        	});
				
		    },

		    eventClick: function(calEvent) {

	        	$('#editEventTitle').attr('value', calEvent.title);
	        	$('#editEventdesc').attr('value', calEvent.description);
	        	$('#editEventcolor').attr('value', calEvent.backgroundcolor);

	        	
		    	
		    	$('#editEvent').dialog({

	        		title: 'Editar nota',
				  	buttons: [

				  	{
				    	text: "Guardar",
				    	click: function(){
				    		$( this ).dialog( "close" );
				    		$.ajax({
					        	headers:
							    {
							        'X-CSRF-Token': $('input[name="_token"]').val()
							    },
				        		url: 'calendario/edit',
				        		type: 'POST',
				        		data: { id: calEvent.id ,title: $('#editEventTitle').val(), description: $('#editEventdesc').val(),  backgroundColor: $('#editEventcolor').val() },
				        	})
				        	.done(function() {
				        		console.log("success");
				        		$('#calendar').fullCalendar('updateEvent', calEvent);
				        		location.reload();
				        	})
				        	.fail(function() {
				        		console.log("error");
				        	})
				        	.always(function() {
				        		console.log("complete");
				        	});
				    	},
				    },
				    {
				      	text: "Eliminar",
				      
				      	click: function() {
				        	$( this ).dialog( "close" );
				        	$.ajax({
				        		headers:
							    {
							        'X-CSRF-Token': $('input[name="_token"]').val()
							    },
				        		url: 'calendario/destroy',
				        		type: 'POST',
				        		data: { id: calEvent._id },
				        		success: function(resultado){
				        			
				        			if(resultado == 'Ok'){
				        				$('#calendar').fullCalendar('removeEvents', calEvent._id);
				        			}else{
				        				errorCal();
				        			}
				        		}
				        	})
				        	.done(function() {
				        		console.log("success");
				        	})
				        	.fail(function() {
				        		console.log("error");
				        	})
				        	.always(function() {
				        		console.log("complete");
				        	});
				      	},
				    }
				  ]
				});
		    },

       	    eventDrop: function(event) {

		    	$.ajax({
	        		headers:
				    {
				        'X-CSRF-Token': $('input[name="_token"]').val()
				    },
	        		url: 'calendario/update',
	        		type: 'POST',
	        		data: { id: event['id'], start: event['start'].format() },
	        	})
	        	.done(function() {
	        		console.log("success");
	        		$('#calendar').fullCalendar('updateEvent', event);
	        	})
	        	.fail(function() {
	        		console.log("error");
	        		errorCal();
	        	})
	        	.always(function() {
	        		console.log("complete");
	        	});
		    },

		    eventMouseover: function( event ) { 

		    	$('#calendar').on('mouseenter', function(e) {

		    		$(document).text('<div style=" top:'+e.pageY-50+'; left: '+e.pageX+'; position: absolute; border: 1px solid black; padding: 5px">Hola</div>');
		    		
		    	});
		    },

		    eventMouseout: function( event ) {

		    },
        });
    });
</script>