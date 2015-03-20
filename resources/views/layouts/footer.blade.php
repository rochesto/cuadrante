<div>
	<input type="hidden" data-data="{{ $events }}" id="eventos" />
	<input type="hidden" data-data="{{ $turnos }}" id="turnosFooter" />
	<input type="hidden" data-data="{{ $horas }}" id="horasFooter" />
	<input type="hidden" data-data="{{ $mes }}" id="mesFooter" />
	<input type="hidden" data-data="{{ $year }}" id="yearFooter" />
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
    	var horas = $('#horasFooter').data('data');
    	var hoy = new Date();
    	var dia = new Date();
    	dia = new Date($('#yearFooter').data('data'), $('#mesFooter').data('data') - 1, 01);

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


	    $('#turnosContent').append('<div id="btnNewEvent"><a class="btn btn-default" href="perfil">Editar</a></div>');


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
	    $('#allEventDiv').hide();
	    $('#divNewNota').hide();
	    

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
	   
	   	// 
	   	// Gestion de nuevo evento
	   	// 
	   	
	   	$('#btnNewNota').on('click', function(event) {
	   		event.preventDefault();

	   		$("#dateNewNota").attr('value', Date("d-m-Y"));

	   		$('#divNewNota').dialog({
	   			title: "Nueva nota",
	   			draggable: true,

	   			buttons: [
	   			{
			  		text: "Cancelar",
			  		click: function(){
			  			$( this ).dialog( "close" );
			  		}
			  	},
			   	{
			      	text: "Añadir",
			      	
			      	click: function() {
			        	$( this ).dialog( "close" );

			        	$.ajax({
				        	headers:
						    {
						        'X-CSRF-Token': $('input[name="_token"]').val()
						    },
			        		url: 'calendario/add',
			        		type: 'POST',
			        		data: { id: 0, title: $('#titleNewNota').val(), start: $('#dateNewNota').val(), backgroundColor:  $('#colorNewNota').val()},
			        		success: function(resultado){
			        			if(resultado == 'Ok'){
        							$('#calendar').fullCalendar('render');
			        			}
			        			else{
			        				errorCal();
			        			}
			        		},
			        	});
			      	},	
				}]
	   		});
	   	});

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
            weekNumbers: true,
	        events: eventos,

	        dayClick: function(date){

       			currentMonth = $('#calendar').fullCalendar('getDate');
       			currentMonth = currentMonth.format('MM');

	        	jQuery.each(turnos, function(index, val) {

		    		$('#allEvent').append('<option id="turnoActual" style="background-color:'+val['backgroundColor']+'" data-turno="'+val['title']+'" data-description="'+val['description']+'" value="'+ val['id'] +'">'+val['title']+'</option>');
			    }); 

	        	var title = $("#addEventDiv");

	        	$('#allEventDiv').dialog({

	        		title: 'Añadir turno. Día: ' + date.format(),

				  	buttons: [
				  	{
				  		text: "Cancelar",
				  		click: function(){
				  			$( this ).dialog( "close" );
				  		}
				  	},
				    {
				      	text: "Añadir",
				      
				      	click: function() {
				        	$( this ).dialog( "close" );

				        	var id = $('#allEvent').val();
				        	var datos;
				        	jQuery.each(turnos, function(index, val) {
				        		if(val['id'] == id){
				        			datos = {id: val['id'], title: val['title'], start: date.format(), backgroundColor: val['backgroundColor']};
				        		}
				        	});

				        	console.log(datos);

				        	$.ajax({
					        	headers:
							    {
							        'X-CSRF-Token': $('input[name="_token"]').val()
							    },
				        		url: 'calendario/add',
				        		type: 'POST',
				        		data: datos,
				        		success: function(resultado){
				        			if(resultado == 'Ok'){
	        							$('#calendar').fullCalendar('render');
	        							location.reload();
				        			}
				        			else{
				        				errorCal();
				        			}
				        		},
				        	})
				      	},	
				    }
				]});
				chargeHours();
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
	        				chargeHours();
	        			}else if(resultado == 'Oka'){
	        				location.reload();
	        			}
	        			else{
	        				errorCal();
	        			}
	        		}
	        	});
	        	chargeHours();

		    },

		    eventClick: function(calEvent) {

	        	$('#editEventTitle').attr('value', calEvent.title);
	        	$('#editEventdesc').attr('value', calEvent.description);
	        	$('#editEventcolor').attr('value', calEvent.backgroundcolor);

	        	
		    	
		    	$('#editEvent').dialog({

	        		title: 'Editar nota',
				  	buttons: [

				  	{
				    	text: "Editar",
				    	click: function(){
				    		$( this ).dialog( "close" );
				    		$.ajax({
					        	headers:
							    {
							        'X-CSRF-Token': $('input[name="_token"]').val()
							    },
				        		url: 'calendario/edit',
				        		type: 'POST',
				        		data: { id: calEvent.id ,title: $('#editEventTitle').val(), backgroundColor: $('#editEventcolor').val() },
				        	})
				        	.done(function() {
				        		$('#calendar').fullCalendar('updateEvent', calEvent);
				        		location.reload();
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
				        	});
				        	chargeHours();
				      	},
				    }
				  ]
				});
				chargeHours();
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
	        		$('#calendar').fullCalendar('updateEvent', event);
	        	});
	        	chargeHours();
		    },

        });

		/*
		//Cambia el mes actual al dato por la url
		 */
		
		$('#calendar').fullCalendar('gotoDate', dia );


		function reloadPage(mes, year){

			var url = "{{ URL::to('calendario?month=meszzyear=ano') }}";
			url = url.replace('mes', mes);
			url = url.replace('ano', year);
			url = url.replace('zz', '&');
			window.location = url;
		}

		$('.fc-today-button').click(function() {
		    reloadPage(hoy.getMonth()+1, hoy.getFullYear());
		});

		$('.fc-prev-button').click(function(e) {
			var mes = dia.getMonth();
			reloadPage(mes, $('#yearFooter').data('data'));	
		});

		$('.fc-next-button').click(function(e) {
			var mes = dia.getMonth();
			mes = mes + 2;
			reloadPage(mes, $('#yearFooter').data('data'));
		});


		// 
		//Cargamos las horas de cada semana
		//
		function chargeHours(){
			$.ajax({
        		headers:
			    {
			        'X-CSRF-Token': $('input[name="_token"]').val()
			    },
        		url: 'calendario/horas',
        		type: 'POST',
        		data: { 'month': dia.getMonth()+1, 'year': dia.getFullYear()},
        		success: function(resultado){
        			resultado = JSON.parse(resultado);
        			
        			$('#horasColText').text('');
					$('#horasColText').append('<tr id="horasColRightTitle" ><th>Horas</th><th>restantes</th></tr>');
					var num = 1;
					for (var i = 1; i < Object.keys(resultado).length - 2; i++) {
						
						
						var text = 'semana'+i;
						var rest = 37.5 - parseInt(resultado[text]);

						if (resultado['primeraSemana'] > num || num > resultado['numeroSemanas']){
							$('#horasColText').append('<tr><td id="horasColText'+i+'" style="height: '+$(".fc-week").css('height')+'">'+resultado[text]+'</td><td>'+rest+'</td></tr>');
							num = num + 1;
						}else{
							$('#horasColText').append('<tr><td id="horasColText'+i+'" style="height: '+$(".fc-week").css('height')+'; background-color: #faa">'+resultado[text]+'</td><td style="height: '+$(".fc-week").css('height')+'; background-color: #faa">'+rest+'</td></tr>');
							num = num + 1;
						}
						
					};	
					$('#horasColText').append('<tr id="horasColRightTitle"><th>Horas ciclo</th></tr><tr><td id="horasColTotal">'+resultado['semana']+'</td></tr>');
        		},
        	});
		}
		
		chargeHours();


    });
</script>