@extends ('layouts.base')
    
@section('header')
    
@stop


@section('content')

    <section class="content">
        <div id="errorCal" class="errorCal"></div>
        <div class="row">
            <div class="col-md-4">
        		<div class="box box-primary">
                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                        <i class="fa fa-list-alt"></i>
                        <h3 class="box-title">Turnos</h3>
                        <!-- <div class="box-tools pull-right">
                            <ul class="pagination pagination-sm inline">
                                <li><a href="#">«</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">»</a></li>
                            </ul>
                        </div> -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <ul class="todo-list ui-sortable turnosBox" id="turnosBox">

                        </ul>
                    </div><!-- /.box-body -->
                    <div class="box-body" id="turnoAdd">
                    	<h3>Añadir turno</h3>
                    	<input type="text" placeholder="Evento" size="14" id="turnoAddTitle">
                    	Color: <input type="color" value="#0055cc" id="turnoAddColor">
                    	Horas: <input type="number" value="8" id="turnoAddHoras" min="1" max="24" step="0.1">
                    	<button id="turnoAddSubmit">Guardar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                        <i class="fa fa-user"></i>
                        <h3 class="box-title">Permisos</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body" id="profileHoras">
                        <p id="profileHorasPAP">Asuntos Propios: <input type="number" size="4" max="30" min="0" id="profileHorasAP"></p>
                        <p id="profileHorasPVacaciones">Vacaciones: <input type="number" size="4" max="30" min="0" id="profileHorasVacaciones"></p>
                        <p id="profileHorasPPU">Permiso Urgente: </p>
                        <p id="profileHorasPBaja">Baja: </p>
                        <p> <button id="profileHorasGuardar">Guardar</button><img src="img/load2.gif" width="30" id="profileBajaLoad"> <b id="profileHorasGuardarB"></b> </p>


                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    
   
@stop

@section('footer')
	@include('layouts.footerProfile')
@stop