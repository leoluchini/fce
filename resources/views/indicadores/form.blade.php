<div class="container">
  @include('generic.breadcrumb_multiple',['modulo' => $accion_breadcrumb, 'enlaces' => array('&Aacute;rbol de indicadores' => $cancelar)])
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
		{!! Form::model($indicador, array('action' => $accion, 'method' => $metodo, 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')) !!}
		<div class="col-md-12">
			{!! Form::hidden('categoria_id', $categoria->id, array('class' => 'form-control')) !!}
			@include('generic.campos_comunes',['object' => $indicador])
			<div class="form-group">
				{!! Form::submit($boton, array('class' => 'btn btn-primary btn-block')) !!}
				<a href="{{ $cancelar }}" class="btn btn-default btn-block">Cancelar</a>
			</div>

		</div>
		{!! Form::close() !!}
	</div>
</div>
