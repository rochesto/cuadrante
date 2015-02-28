@extends ('layouts.base')
    
@section('header')
    
@stop


@section('content')
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <small>Panel de Control</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Cuadrante</li>
        </ol>
    </section>
    
    @include('layouts.calendarEdit')
    
@stop