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
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <h4 id="btnNewTurno" ><button class="btn btn-default">Añadir turno</button></h4>

                        <ul class="todo-list ui-sortable turnosBox" id="turnosBox">

                        </ul>
                    </div><!-- /.box-body -->

                    <div class="box-body" id="turnoAdd">
                        Título: <input type="text" placeholder="Título" size="14" id="turnoAddTitle">
                        <br>
                        Color: <input type="color" value="#0055cc" id="turnoAddColor">
                        <br>
                        Horas: <input type="number" value="8" id="turnoAddHoras" min="1" max="24" step="0.1">
                        <br>
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
                    <table class="table table-striped">
                        <tr>
                            <td>Asuntos Propios: </td>
                            <td><input type="number" size="4" max="30" min="0" id="profileHorasAP"></td>
                        </tr>
                        <tr>
                            <td>Vacaciones: </td>
                            <td><input type="number" size="4" max="30" min="0" id="profileHorasVacaciones"></td>
                        </tr>
                        <tr>
                            <td>Baja:</td>
                            <td id="profileHorasPBaja"></td>
                        </tr>
                        <tr>
                            <td>Permiso Urgente:</td>
                            <td><div id="profileHorasPPU"></div></td>
                        </tr>
                        <tr>
                            <td>Indisposición:</td>
                            <td><div id="profileHorasInd"></div></td>
                        </tr>
                        <tr>
                            <td>Examenes:</td>
                            <td><div id="profileHorasExa"></div></td>
                        </tr>
                        <tr>
                            <td>Horas semanales:</td>
                            <td><select name="profileHorasSem" id="profileHorasSem">
                                    <option value="37.5">37.5</option>
                                    <option value="40">40</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><button id="profileHorasGuardar">Guardar</button></td>
                        </tr>
                       
                    </table>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    
   
@stop

@section('footer')
	@include('layouts.footerProfile')
@stop