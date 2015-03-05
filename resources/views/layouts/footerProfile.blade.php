<div>
    <input type="hidden" data-data="{{ $turnos }}" id="turnosFooter" />
    <input type="hidden" data-data="{{ $horas }}" id="horasFooter" />
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
</div>

<script>
	
	$(document).ready(function(){

		var turnos = $('#turnosFooter').data('data');
        var horas = $('#horasFooter').data('data');

		$('.ui-sortable').sortable();
        $('#profileBajaLoad').hide();


		//Funcion imprimir error
	    function errorCal(){
	    	$('#errorCal').html('<button class="btn btn-danger disabled"><h4 class=""><i class="fa fa-refresh"></i> Se necesita recargar. Click aquí <i class="fa fa-refresh"></i></h4></button>').css('cursor', 'click').click(function() {
    			location.reload();
			});
	    }

        /*
        Gestion de turnos
         */
        
        //imprimir turnos
		jQuery.each(turnos, function(index, val) {

			if(!val['user_id'] == 1000){
				$('#turnosBox').append('<li><span class="handle ui-sortable-handle"></span><span class="text" style="background-color: '+val['backgroundColor']+'; color: white; border-radius: 5px; "> '+val['title']+'</span></li>');
			}else{

				$('#turnosBox').append('<li data-data="'+val['id']+'" class="turnosLi"><span class="handle ui-sortable-handle"></span><span class="text" style="background-color: '+val['backgroundColor']+'; color: white; border-radius: 5px; "> '+val['title']+'</span><div class="tools"><a href="turnos/delete"><i class="fa fa-trash-o"></i></a></div></li>'
	    		);
			}
	    	
	    });

	    $('.turnosLi').on('click', function(event) {
	    	event.preventDefault();

	    	$.ajax({
        		headers:
			    {
			        'X-CSRF-Token': $('input[name="_token"]').val()
			    },
        		url: 'turnos/delete',
        		type: 'POST',
        		data: { id: event['currentTarget']['attributes'][0]['value'] },
        		success: function(resultado){
        			if(resultado == 'Ok'){
        				location.reload();
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
	    });

	    $('#turnoAddSubmit').on('click', function(event) {
	   		event.preventDefault();
            $('#profileBajaLoad').show();

	   		$.ajax({
	        	headers:
			    {
			        'X-CSRF-Token': $('input[name="_token"]').val()
			    },
        		url: 'calendario/turno',
        		type: 'POST',
        		data: {title: $('#turnoAddTitle').val(), backgroundColor: $('#turnoAddColor').val(), horas: $('#turnoAddHoras').val() },
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
        Gestionas horas user
         */
        
        $('#profileHorasAP').attr('value', horas[0]['asuntos_propios']);
        $('#profileHorasVacaciones').attr('value', horas[0]['vacaciones']);
        $('#profileHorasPPU').append(horas[0]['permiso_urgente']);
        $('#profileHorasPBaja').append(horas[0]['baja']);
        $('#profileHorasGuardar').on('click', function(event) {
            event.preventDefault();

            $.ajax({
                headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                url: 'perfil/update',
                type: 'POST',
                data: {id: horas[0]['id'], asuntos_propios: $('#profileHorasAP').val(), vacaciones: $('#profileHorasVacaciones').val() },
                success: function(resultado){
                    if (resultado == 'Ok') {
                        
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
            
        });
	});


</script>