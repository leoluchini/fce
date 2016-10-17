<div class="panel panel-default">
	<!-- CATEGORIA -->
	<div class="panel-heading var_nivel_{{$nivel}}" role="tab" id="heading_{{$zona->id}}">
	  <h4 class="panel-title">
	    <a class="pull-left" role="button" data-toggle="collapse" data-parent="#{{$grupo}}" href="#collapse_{{$zona->id}}" aria-expanded="true" aria-controls="collapseOne">
	      <p class="blanco"><strong>{{$zona->codigo}}</strong> - {{$zona->nombre}}</p>
	    </a>
		  <div class="pull-right">
		  	<a title="Editar zona geografica" href="{{ action('ZonaGeograficaController@edit', [$zona->tipo, $zona->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-pencil blanco"></span></a>
			&nbsp;
			<a title="Eliminar zona geografica" href="{{ action('ZonaGeograficaController@destroy', [$zona->tipo, $zona->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar zona geografica" data-confirm="¿Estas seguro que desea eliminar la zona geografica '{{$zona->nombre}}' ?"><span class="glyphicon glyphicon-trash blanco"></span></a>
		  </div>
		  <div class="clearfix"></div>
	  </h4>
	</div>
	<!-- FIN CATEGORIA -->

	@if($zona->tieneHijos())
		<div id="collapse_{{$zona->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		  <div class="panel-body">
		  	<?php $nivel++; ?>
			@foreach($zona->hijos as $subzona)
				<div class="panel-group" id="accordion_{{$subzona->id}}" role="tablist" aria-multiselectable="true">
					@include('zonas.panel',['zona' => $subzona, 'grupo' => 'accordion_'.$subzona->id, 'nivel' => $nivel])
				</div>
			@endforeach
		  </div>
		</div>
	@endif
</div>