<div class="container">
    <div class="row">
      <div class="col-xs-12"> 
        <div class="page-header">
		  @include('generic.breadcrumb_multiple',['modulo' => $accion_breadcrumb, 'enlaces' => array('Fuentes' => $cancelar)])
          <h1>
            <span class="icon-edit"></span>
            {{$titulo}}
          </h1>
      </div>
    </div>
  </div>
</div>

<div class="page-body">
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			{!! Form::model($fuente, array('action' => $accion, 'method' => $metodo, 'class' => 'form-horizontal')) !!}
			<div class="col-md-12">
				@include('generic.campos_comunes',['object' => $fuente])
				<div class="form-group">
					{!! Form::submit($boton, array('class' => 'btn btn-primary btn-block')) !!}
					<a href="{{ $cancelar }}" class="btn btn-default btn-block">Cancelar</a>
				</div>

			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
