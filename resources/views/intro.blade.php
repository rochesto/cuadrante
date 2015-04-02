@extends ('layouts.base')
    
@section('header')
    
@stop


@section('content')

    <section class="content">
        
		<div class="row">
			<div class="col-md-5">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Novedades</h3>
					</div><!-- /.box-header -->
					<br>
					<?php foreach ($noticias as $noticia): ?>
					    <div class="callout callout-info">
		                    <h4>{{ $noticia->title }}</h4>
		                    <p>{{ $noticia->body }}</p>
		                </div>
				    <?php endforeach; ?>
				</div>
			</div>
			{{-- <div class="col-md-3">
	            <iframe width="440" height="260" src="https://www.youtube.com/embed/kGtWBw7IkMM" frameborder="0" ></iframe>
			</div> --}}		
			<div class="col-md-6">
				<div class="box box-warning">
					<div class="box-header">
						<h3 class="box-title">Comentarios Y sugerencias</h3>
					</div><!-- /.box-header -->
					<br>
					<div class="box-body">
              			{!! Form::open(array('url' => 'comment/store')) !!}
              			{!! Form::label('Nombre') !!}
              			<br>
						{!! Form::text('user') !!}
						<br>
						{!! Form::label('Comentario') !!}
						<br>
						{!! Form::textarea('comentario', null, ['size' => '60x3']) !!}
						<br>
						{!! Form::submit('Comentar'); !!}
              			{!! Form::close() !!}
            		</div><!-- /.box-body -->
					<?php foreach ($comentarios as $comment): ?>
					    <div class="callout callout-warning">
		                    <h4>{{ $comment->user }}</h4>
		                    <p>{{ $comment->body }}</p>
		                </div>
				    <?php endforeach; ?>
				    <?php echo $comentarios->render(); ?>
				</div>
        	</div>
		</div>
			



    </section>
    
   
@stop

@section('footer')
	
@stop