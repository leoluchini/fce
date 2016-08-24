<div class="col-md-10 col-md-offset-1">
	<h3>
		<span>{{$titulo}}</span>
	</h3>
	
</div>

<div class="col-md-8 col-md-offset-2">
	{!! Form::model($zona, array('action' => $accion, 'method' => $metodo, 'class' => 'form-horizontal')) !!}
	<div class="col-md-12">
		@include('generic.campos_comunes',['object' => $zona])
		@if ($zona->tipo)
			@if ($zona->tipo != 'pais')
				<div class="form-group @if ($errors->first('zona_padre_id')){!! 'has-error' !!}@endif">
					{!! Form::label('zona_padre_id', '*'.$tipos_zonas[$zona->tipo].' padre', array('class' => 'control-label')) !!}
					{!! Form::select('zona_padre_id', $zonas, $zona->zona_padre_id, array('class' => 'form-control')) !!}
					@if ($errors->first('zona_padre_id'))<span class="help-block">{{$errors->first('zona_padre_id')}}</span>@endif
				</div>
			@endif
		@else
			<div class="form-group @if ($errors->first('tipo')){!! 'has-error' !!}@endif">
				{!! Form::label('tipo', '*Tipo', array('class' => 'control-label')) !!}
				{!! Form::select('tipo', $tipos_zonas, $zona->tipo, array('class' => 'form-control')) !!}
				{!! Form::hidden('zona_padre_id', null, array('class' => 'form-control')) !!}
				@if ($errors->first('tipo'))<span class="help-block">{{$errors->first('tipo')}}</span>@endif
			</div>
			<div class="form-group @if ($errors->first('zona_padre_id')){!! 'has-error' !!}@endif">
				@if ($errors->first('zona_padre_id'))<span class="help-block">{{$errors->first('zona_padre_id')}}</span>@endif
			</div>
			<div class="form-group" id="select_paises" style="display:none">
				{!! Form::select('paises', $paises, null, array('class' => 'form-control')) !!}
			</div>
			<div class="form-group" id="select_provincias" style="display:none">
				{!! Form::select('provincias', $provincias, null, array('class' => 'form-control')) !!}
			</div>
		@endif
		<div class="form-group">
			{!! Form::submit($boton, array('class' => 'btn btn-primary btn-block')) !!}
			<a href="{{ $cancelar }}" class="btn btn-default btn-block">Cancelar</a>
		</div>

	</div>
	{!! Form::close() !!}
</div>
<script src="{{ asset('js/zonas_geograficas.js') }}"></script>