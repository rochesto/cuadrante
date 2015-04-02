<div>
	<input type="hidden" data-data="{{ $events }}" id="eventos" />
	<input type="hidden" data-data="{{ $turnos }}" id="turnosFooter" />
	<input type="hidden" data-data="{{ $horas }}" id="horasFooter" />
	<input type="hidden" data-data="{{ $mes }}" id="mesFooter" />
	<input type="hidden" data-data="{{ $year }}" id="yearFooter" />
	<input type="hidden" data-data="{{ $horasProfile }}" id="horasProfileFooter" />
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
    	var horasProfile = $('#horasProfileFooter').data('data');
    	horasProfile = horasProfile[0]['horas_semanales'];
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
	    $('#turnoAdd').hide();

	    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

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

	    /***************************************
	    /
	    /	Funciones ventana emergente
	    /
	    ***************************************/
	   
	   //
	   //
	   //	Dialog nuevo turno
	   //
	   //
	   
	   	$('#btnNewTurno').on('click', function(event) {
	   		event.preventDefault();

	   		// $("#dateNewNota").attr('value', Date("d-m-Y"));

	   		$('#turnoAdd').dialog({
	   			title: "Nuevo Turno",
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
			      	},	
				}]
	   		});
	   	});
	   
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
			        		data: { id: 0, title: $('#titleNewNota').val(), start: $('#datepicker').val(), backgroundColor:  $('#colorNewNota').val()},
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
				        			datos = {id: val['id'], title: val['title'], start: date.format(), end: date.format(), backgroundColor: val['backgroundColor']};
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
				        	.fail(function() {
				        		errorCal();
				        	});
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
                // copiedEventObject.allDay = allDay;
                copiedEventObject.backgroundColor = $(this).css("background-color");
                copiedEventObject.borderColor = "black";

    //         	nextDay = new Date(date);
    //         	console.log(nextDay);
				// nextDay = new Date(nextDay.getDate() + 1);
    //         	console.log(nextDay);


		        $.ajax({
		        	headers:
				    {
				        'X-CSRF-Token': $('input[name="_token"]').val()
				    },
	        		url: 'calendario/add',
	        		type: 'POST',
	        		data: {id: $(this).data('id'), title: $(this).data('turno'), description: $(this).data('description'), start: date.format(), end: date.format()	, backgroundColor: $(this).css("background-color") },
	        		success: function(resultado){
	        			if(resultado == 'Ok'){
	        				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
	        				location.reload();
	        				chargeHours();
	        			}else if(resultado == 'Oka'){
	        				location.reload();
	        			}
	        			else{
	        				errorCal();
	        			}
	        		}
	        	})
	        	.fail(function() {
	        		errorCal();
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
       	    	if (event['end']) {
       	    		$end = event['end'].format();
       	    	}else{
       	    		$end = event['start'].format();
       	    	};

		    	$.ajax({
	        		headers:
				    {
				        'X-CSRF-Token': $('input[name="_token"]').val()
				    },
	        		url: 'calendario/update',
	        		type: 'POST',
	        		data: { id: event['id'], start: event['start'].format(), end: $end },
	        		success: function(resultado){
	        			if(resultado == 'Ok'){
	        				$('#calendar').fullCalendar('updateEvent', event);
	        			}else{
	        				errorCal();
	        			}
	        		}
	        	})
	        	.fail(function() {
	        		errorCal();
	        	});
	        	chargeHours();
		    },
		    eventResize: function(event, delta, revertFunc) {

		        $.ajax({
	        		headers:
				    {
				        'X-CSRF-Token': $('input[name="_token"]').val()
				    },
	        		url: 'calendario/resize',
	        		type: 'POST',
	        		data: { id: event['id'], start: event['start'].format(), end: event['end'].format() },
	        		success: function(resultado){
	        			console.log(resultado);
	        			if(resultado == 'Ok'){
	        				$('#calendar').fullCalendar('updateEvent', event);
	        			}else{
	        				errorCal();
	        			}
	        		}
	        	})
	        	.fail(function() {
	        		errorCal();
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
			var year = $('#yearFooter').data('data');
			if(mes < 1){
				mes = 12;
				year = year - 1;
			}
			reloadPage(mes, year);	
		});

		$('.fc-next-button').click(function(e) {
			var mes = dia.getMonth();
			var year = $('#yearFooter').data('data');

			mes = mes + 2;
			if(mes > 12){
				mes = 1;
				year = year + 1;
			}

			reloadPage(mes, year);
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
					$('#horasColText').append('<tr id="horasColRightTitle" ><th>Horas</th><th>Restantes</th></tr>');
					var contador = 1;
					for (var i = 1; i < Object.keys(resultado).length - 2; i++) {
						
						
						var text = 'semana'+i;
						var rest = horasProfile - parseFloat(resultado[text]);
						var restMes = (horas['numeroSemanas'] * horasProfile) - resultado['semana'];

						if(resultado['primeraSemana'] == 1){
							if (resultado['numeroSemanas'] >= contador){
								$('#horasColText').append('<tr><td id="horasColText'+i+'" style="height: '+$(".fc-week").css('height')+'; background-color: #cdd1f7">'+resultado[text]+'</td><td style="height: '+$(".fc-week").css('height')+'; background-color: #cdd1f7">'+rest+'</td></tr>');
								contador = contador + 1;
							}else{
								$('#horasColText').append('<tr><td id="horasColText'+i+'" style="height: '+$(".fc-week").css('height')+'">'+resultado[text]+'</td><td>'+rest+'</td></tr>');
							}
						}else{
							if (resultado['numeroSemanas'] >= contador-1 && resultado['primeraSemana'] <= contador){
								$('#horasColText').append('<tr><td id="horasColText'+i+'" style="height: '+$(".fc-week").css('height')+'; background-color: #cdd1f7">'+resultado[text]+'</td><td style="height: '+$(".fc-week").css('height')+'; background-color: #cdd1f7">'+rest+'</td></tr>');
								contador = contador + 1;
							}else{
								$('#horasColText').append('<tr><td id="horasColText'+i+'" style="height: '+$(".fc-week").css('height')+'">'+resultado[text]+'</td><td>'+rest+'</td></tr>');
								contador = contador + 1;
							}
						}


					};	
					$('#horasColText').append('<tr id="horasColRightTitle"><th>Horas ciclo</th><th>Restantes</th></tr><tr><td id="horasColTotal">'+resultado['semana']+'</td><td>'+restMes+'</td></tr>');
        		},
        	});
		}
		
		chargeHours();


    });
</script>