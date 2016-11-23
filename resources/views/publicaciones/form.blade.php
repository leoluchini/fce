<div class="container">
  @include('generic.breadcrumb_multiple',['modulo' => $accion_breadcrumb, 'enlaces' => array('Categor&iacute;as y publicaciones' => action('CategoriaController@index'), 'Publicaciones' => $cancelar)])
    <div class="row">
      <div class="col-xs-12"> 
        <div class="page-header">
          <h1>
            <span class="icon-edit"></span>
            {{$titulo}}
          </h1>
      </div>
    </div>
  </div>

	<div class="col-md-8 col-md-offset-2">
		{!! Form::model($publicacion, array('action' => $accion, 'method' => $metodo, 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')) !!}
		<div class="col-md-12">
			<div class="form-group @if ($errors->first('nombre')){!! 'has-error' !!}@endif">
				{!! Form::label('nombre', '*Nombre', array('class' => 'control-label')) !!}
				{!! Form::text('nombre', $publicacion->nombre, array('class' => 'form-control')) !!}
				@if ($errors->first('nombre'))<span class="help-block">{{$errors->first('nombre')}}</span>@endif
			</div>
			<div class="form-group @if ($errors->first('descripcion')){!! 'has-error' !!}@endif">
				{!! Form::label('descripcion', '*Descripcion', array('class' => 'control-label')) !!}
				{!! Form::textarea('descripcion', $publicacion->descripcion, array('class' => 'form-control')) !!} 
				@if ($errors->first('descripcion'))<span class="help-block">{{$errors->first('descripcion')}}</span>@endif
			</div>
			<div class="form-group @if ($errors->first('palabras_clave')){!! 'has-error' !!}@endif">
				{!! Form::label('palabras_clave', '*Palabras clave', array('class' => 'control-label')) !!}
				{!! Form::textarea('palabras_clave', $publicacion->palabras_clave, array('class' => 'form-control')) !!} 
				@if ($errors->first('palabras_clave'))<span class="help-block">{{$errors->first('palabras_clave')}}</span>@endif
			</div>
			<div class="form-group @if ($errors->first('anio_publicacion')){!! 'has-error' !!}@endif">
				{!! Form::label('anio_publicacion', '*Año', array('class' => 'control-label')) !!}
				
				{!! Form::select('anio_publicacion', $anios, $publicacion->anio_publicacion, array('class' => 'form-control')) !!}
				@if ($errors->first('anio_publicacion'))<span class="help-block">{{$errors->first('anio_publicacion')}}</span>@endif
			</div>
			@if($metodo == 'POST')
				<div class="form-group @if ($errors->first('archivo')){!! 'has-error' !!}@endif">
					{!! Form::label('archivo', 'Archivo', array('class' => 'control-label')) !!}
					<span title="Seleccionar archivo" class="glyphicon glyphicon-upload pull-right input_file_image" data-inputid="archivo" data-containerid="informe_name_container"></span>
					
					<div class="col-xs-12">
						{!! Form::file('archivo', ['id' => 'archivo', 'style' => 'display:none']) !!}
						<div id="informe_name_container" class="text-center">
						 	Ningún archivo seleccionado
						</div>
					</div>
					@if ($errors->first('archivo'))<span class="help-block">{{$errors->first('archivo')}}</span>@endif
				</div>
			@else
				<div class="form-group">
					{!! Form::label('archivo', 'Archivo', array('class' => 'control-label')) !!}
					<div class="col-xs-12">
						<div id="informe_name_container" class="text-center">
						 	{{$publicacion->archivo}}
						</div>
					</div>
					@if ($errors->first('archivo'))<span class="help-block">{{$errors->first('archivo')}}</span>@endif
				</div>
			@endif
			<div class="form-group">
				{!! Form::submit($boton, array('class' => 'btn btn-primary btn-block')) !!}
				<a href="{{ $cancelar }}" class="btn btn-default btn-block">Cancelar</a>
			</div>

		</div>
		{!! Form::close() !!}
	</div>
</div>
