	<div class="panel panel-default">
		

		<!-- CATEGORIA -->
		<div class="panel-heading var_nivel_{{$nivel}}" role="tab" id="heading_{{$categoria->id}}">
		  <h4 class="panel-title">
		    <a class="pull-left" role="button" data-toggle="collapse" data-parent="#{{$grupo}}" href="#collapse_{{$categoria->id}}" aria-expanded="true" aria-controls="collapseOne">
		      <p class="blanco"><strong>{{$categoria->codigo}}</strong> - {{$categoria->nombre}}</p>
		    </a>
			  <div class="pull-right">
			  	<a title="Editar categoria" href="{{ action('CategoriaIndicadorController@edit', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-edit blanco"></span></a>
				&nbsp;<a title="Nueva subcategoria" href="{{ action('CategoriaIndicadorController@create_sub', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-right-thin blanco"></span></a>
				&nbsp;<a title="Nuevo indicador" href="{{ action('IndicadorController@create', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-level-down blanco"></span></a>
				&nbsp;<a title="Eliminar categoria" href="{{ action('CategoriaIndicadorController@destroy', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar categoria" data-confirm="¿Estas seguro que desea eliminar la categoria '{{$categoria->nombre}}' ?"><span class="icon-trash-4 blanco"></span></a>
			  </div>
			  <div class="clearfix"></div>
		  </h4>
		</div>
		<!-- FIN CATEGORIA -->


		<div id="collapse_{{$categoria->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		  <div class="panel-body">
	  		<?php $nivel++; ?>
			@foreach($categoria->subcategorias as $subcategoria)
					<div class="panel-group" id="accordion_{{$subcategoria->id}}" role="tablist" aria-multiselectable="true">
							@include('categorias_variables.panel',['categoria' => $subcategoria, 'grupo' => 'accordion_'.$subcategoria->id, 'nivel' => $nivel])
					</div>
			@endforeach

			<!-- INDICADOR -->
			<ul class="list-group">
    		@foreach($categoria->indicadores as $indicador)
    			<li class="list-group-item">
    				<strong>{{ $indicador->codigo }}</strong> - {{ $indicador->nombre }}
						@if($indicador->tema)
								<span class="label label-default" data-toggle="tooltip" data-placement="right" title="Indicador padre">{{$indicador->tema->nombre}}</span>
						@endif
						<div class="pull-right">
							<a title="Editar indicador" href="{{ action('IndicadorController@edit', [$categoria->id, $indicador->id]) }}" data-toggle="tooltip" data-placement="top">
								<span class="icon-edit"></span>
							</a>

							<a title="Eliminar indicador" href="{{ action('IndicadorController@destroy', [$categoria->id, $indicador->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar indicador" data-confirm="¿Estas seguro que desea eliminar el indicador '{{$indicador->nombre}}' ?">
								<span class="icon-trash-4"></span>
							</a>
						</div>
    			</li>
			@endforeach
			</ul>
			<!-- FIN VARIABLE -->
		  </div>
		</div>
	</div>