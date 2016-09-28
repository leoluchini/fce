	<div class="panel panel-default">
		

		<!-- CATEGORIA -->
		<div class="panel-heading" role="tab" id="heading_{{$categoria->id}}">
		  <h4 class="panel-title">
		    <a class="pull-left" role="button" data-toggle="collapse" data-parent="#{{$grupo}}" href="#collapse_{{$categoria->id}}" aria-expanded="true" aria-controls="collapseOne">
		      <p class="blanco"><strong>{{$categoria->codigo}}</strong> - {{$categoria->nombre}}</p>
		    </a>
			  <div class="pull-right">
			  	<a title="Editar categoria" href="{{ action('CategoriaVariableController@edit', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-edit blanco"></span></a>
				&nbsp;<a title="Nueva Subcategoria" href="{{ action('CategoriaVariableController@create_sub', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-right-thin blanco"></span></a>
				&nbsp;<a title="Nueva Variable" href="{{ action('VariableController@create', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-level-down blanco"></span></a>
				&nbsp;<a title="Eliminar categoria" href="{{ action('CategoriaVariableController@destroy', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar categoria" data-confirm="¿Estas seguro que desea eliminar la categoria '{{$categoria->nombre}}' ?"><span class="icon-trash-4 blanco"></span></a>
			  </div>
			  <div class="clearfix"></div>
		  </h4>
		</div>
		<!-- FIN CATEGORIA -->


		<div id="collapse_{{$categoria->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		  <div class="panel-body">


							@foreach($categoria->subcategorias as $subcategoria)
						<div class="panel-group" id="accordion_{{$categoria->id}}" role="tablist" aria-multiselectable="true">
								@include('categorias_variables.panel',['categoria' => $subcategoria, 'grupo' => 'accordion_'.$categoria->id])
						</div>
							@endforeach



						<!-- VARIABLE -->
	    			<ul class="list-group">
			    		@foreach($categoria->variables as $variable)
			    			<li class="list-group-item">
			    				<strong>{{ $variable->codigo }}</strong> - {{ $variable->nombre }}
									@if($variable->tema)
											<span class="label label-default" data-toggle="tooltip" data-placement="right" title="Variable madre">{{$variable->tema->nombre}}</span>
									@endif
									<div class="pull-right">
										<a title="Editar variable" href="{{ action('VariableController@edit', [$categoria->id, $variable->id]) }}" data-toggle="tooltip" data-placement="top">
											<span class="icon-edit"></span>
										</a>

										<a title="Eliminar variable" href="{{ action('VariableController@destroy', [$categoria->id, $variable->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar variable" data-confirm="¿Estas seguro que desea eliminar la variable '{{$variable->nombre}}' ?">
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