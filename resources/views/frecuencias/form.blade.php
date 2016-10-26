<div class="container">
    <div class="row">
      <div class="col-xs-12"> 
        <div class="page-header">
        	@include('generic.breadcrumb_multiple',['modulo' => $accion_breadcrumb, 'enlaces' => array('Frecuencias' => $cancelar)])
          <h3>
            <span class="icon-edit"></span>
            {{$titulo}}
          </h3>
      </div>
    </div>
  </div>
</div>

<div class="page-body">
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			{!! Form::model($frecuencia, array('action' => $accion, 'method' => $metodo, 'class' => 'form-horizontal')) !!}
			<div class="col-md-12">
				<div class="form-group @if ($errors->first('tipo')){!! 'has-error' !!}@endif">
					{!! Form::label('tipo', '*Tipo', array('class' => 'control-label')) !!}
					{!! Form::select('tipo', $tipos_frecuencias, $frecuencia->tipo, array('class' => 'form-control')) !!}
					@if ($errors->first('tipo'))<span class="help-block">{{$errors->first('tipo')}}</span>@endif
				</div>
				<div class="form-group @if ($errors->first('codigo')){!! 'has-error' !!}@endif">
					{!! Form::label('codigo', '*Codigo', array('class' => 'control-label')) !!}
					{!! Form::text('codigo', $frecuencia->codigo, array('class' => 'form-control')) !!}
					@if ($errors->first('codigo'))<span class="help-block">{{$errors->first('codigo')}}</span>@endif
				</div>
				<div class="form-group @if ($errors->first('nombre')){!! 'has-error' !!}@endif">
					{!! Form::label('nombre', '*Nombre', array('class' => 'control-label')) !!}
					{!! Form::text('nombre', $frecuencia->nombre, array('class' => 'form-control')) !!}
					@if ($errors->first('nombre'))<span class="help-block">{{$errors->first('nombre')}}</span>@endif
				</div>
				<div class="form-group">
					{!! Form::submit($boton, array('class' => 'btn btn-primary btn-block')) !!}
					<a href="{{ $cancelar }}" class="btn btn-default btn-block">Cancelar</a>
				</div>

			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
