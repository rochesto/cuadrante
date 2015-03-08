@extends ('layouts.base')
    
@section('header')
    
@stop


@section('content')
	
    <section class="content">
	
		<div class="row">
			<div class="col-md-2">
				 <div class="box box-primary">
				 	<div class="box-header">
                        <h4><button class=".btn .btn-sm" id="btnNewNota">Añadir nota</button></h4>
                        <div id="divNewNota">
						    <form action="" id ="add-event-form" name="add-event-form">
						        <label for="title">Titulo</label>
						        <input type="text" name="titleNewNota" id="titleNewNota"/>
						        <p>
						        <label for="add-date">Fecha</label>
						        <input type="date" name="dateNewNota" id="dateNewNota" tabindex="-1" />
						        </p>
						        <p>
						        <label for="add-color">Color</label>
						        <input type="color" name="colorNewNota" id="colorNewNota" tabindex="-1" />
						        </p>
						       {{--  <p>
						        <label for="add-start-time">Start Time</label>
						        <input type="text" name="start-time" id="start-time" />
						        </p>
						        <p>
						        <label for="add-end-time">End Time</label>
						        <input type="text" name="end-time" id="end-time" />
						        </p> --}}
						       {{--  <p>
						        <label for="repeats">repeat </label>
						        <input type="checkbox" name="repeats" id="repeats" value="1"/>
						        <div id="repeat-options" >
						             Repeat every: day <input type="radio" value="1" name="repeat-freq" align="bottom">
						             week <input type="radio" value="7" name="repeat-freq" align="bottom">
						             two weeks <input type="radio" value="14" name="repeat-freq" align="bottom">
						        </div> --}}
						    </form>
                        </div>
                    </div>
                    
                    <div class="box-header">
                        <h4 class="box-title">Turnos</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
						<div id="turnosContent" class="draggable">
                            
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
			<div class="col-md-8">
				<div id="errorCal" class="errorCal"></div>
				<div id="editEvent">
					<label for="title">Title</label>
					<input type="text" id="editEventTitle">
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
				<div id="allEventDiv">
					<select name="allEvent" id="allEvent">
						
					</select>
				</div>
				<div id="calendar" class="box box-primary"></div>
			</div>
			<div class="col-md-2" id="prueba">
				<div class="box box-primary">
				 	<div class="box-header">
                        <h4 class="box-title">Horas</h4>
                    </div>
                    <div class="box-body">
                        HOla
                    </div><!-- /.box-body -->
                </div>
			</div>
		</div>
        

    </section>
    
@stop

@section('footer')
	@include('layouts.footer')
@stop