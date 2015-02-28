@extends ('layouts.base')
    
@section('header')
    
@stop


@section('content')
	
    <section class="content">
	
		<div class="row">
			<div class="col-md-2">
				 <div class="box box-primary">
                    <div class="box-header">
                        <h4 class="box-title">Turnos</h4>
                    </div>
                    <div class="box-body">

                        <!-- the events -->
						<div id="turnosContent" class="draggable">
                            <!--  Boton remove
                            <div ><button class="btn-lg" id='drop-remove'><i class="fa fa-recycle	"></i>Eliminar</button></div>
							-->
						</div>

                    </div><!-- /.box-body -->
					<br>
                    <div class="box box-primary">
                        <div class="box-header">
                            <h6 class="box-title">Añadir Evento</h6>
                        </div>
                        <div class="box-body" id="turnoAdd">
                        	<input type="text" placeholder="Evento" size="14" id="turnoAddTitle">
                        	<textarea id="turnoAddDesc" cols="13" rows="2" placeholder="Descripción"></textarea>
                        	<br>
                        	Color: <input type="color" value="#0055cc" id="turnoAddColor">
                        	<br>
                        	Horas: <input type="number" value="8" id="turnoAddHoras" min="1" max="24" step="0.1">
                        	<br>
                        	<button id="turnoAddSubmit">Guardar</button>
                        </div>
                    </div>
                </div><!-- /. box -->

			</div>
			<div class="col-md-10">
				<div id="errorCal" class="errorCal"></div>
				<div id="editEvent">
					<label for="title">Title</label>
					<input type="text" id="editEventTitle">
					<textarea name="editEventdesc" id="editEventdesc" cols="25" rows="3"></textarea>
					<label for="color">Color</label>
					<input type="color" value="#3C8DBC" id="editEventcolor">
				</div>
				<div id="addEvent">
					<form id="addEventForm">
						<label for="title">Title</label>
						<input type="text" id="addEventTitle">
						<textarea name="addEventdesc" id="addEventdesc" cols="25" rows="3" placeholder="Descripcion"></textarea>
						<label for="color">Color</label>
						<input type="color" value="#3C8DBC" id="addEventcolor">
					</form>
				</div>
				<div id="calendar" class="box box-primary"></div>
			</div>
		</div>
        

    </section>
    
@stop

@section('footer')
	@include('layouts.footer')
@stop