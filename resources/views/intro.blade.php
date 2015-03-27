@extends ('layouts.base')
    
@section('header')
    
@stop


@section('content')

    <section class="content">
        
        {{-- <button class="btn btn-primary"><a href="{{ URL::to('calendario?month='.date('m').'&year='.date('Y')) }}">Ir al cuadrante</a></button> --}}
		<div class="row">
			
			<div class="col-md-6">
				<div class="box box-primary">
				    <div class="box-header">
				        <h3 class="box-title">Novedades</h3>
				    </div><!-- /.box-header -->
				    <br>
				    <div class="callout callout-info">
	                    <h4>Presentación</h4>
	                    <p>Descpues de muchas horas de trabajo, estamos orgullosos de presentarles cuadrante.es. Una página donde podran gestionar sus cuadrantes de forma sencilla y visual. Esperemos que les sea de utilidad y siempre agradeceremos sus comentarios.</p>
	                </div>
				</div>
			</div>
			<div class="col-md-3">
	            <iframe width="440" height="260" src="https://www.youtube.com/embed/kGtWBw7IkMM" frameborder="0" allowfullscreen></iframe>
			</div>		
		</div>

		<div class="form-group">
			<div class="col-md-2">
			</div>
			<div class="col-md-7">
          		<div class="box box-warning">
            		<div class="box-header">
              			<h3 class="box-title">Comentarios</h3>
            		</div><!-- /.box-header -->
            		<div class="box-body">
              			<form role="form">
               			<!-- text input -->
                			<div class="form">
                  				<label>Email</label>
                  				<input type="mail" class="form-control" placeholder="Email">
                			</div>
               			<!-- textarea -->
               				<div class="form-group">
                  				<label>Comentario</label>
                  				<textarea class="form-control" rows="5" placeholder=""></textarea>
                			</div>
                			<input type="submit" value="Enviar">
              			</form>
            		</div><!-- /.box-body -->
          		</div><!-- /.box -->
        	</div>
		</div>
			



    </section>
    
   
@stop

@section('footer')
	
@stop