	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="heading_{{$categoria->id}}">
		  <h4 class="panel-title">
		    <a role="button" data-toggle="collapse" data-parent="#{{$grupo}}" href="#collapse_{{$categoria->id}}" aria-expanded="true" aria-controls="collapseOne">
		      {{$categoria->codigo}} - {{$categoria->nombre}}
		    </a>
			  <div class="pull-right">
			  	<a title="Editar categoria" href="{{ action('CategoriaVariableController@edit', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
				&nbsp;<a title="Nueva Subcategoria" href="{{ action('CategoriaVariableController@create_sub', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
				&nbsp;<a title="Nueva Variable" href="{{ action('VariableController@create', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus-sign"></span></a>
				&nbsp;<a title="Eliminar categoria" href="{{ action('CategoriaVariableController@destroy', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar categoria" data-confirm="¿Estas seguro que desea eliminar la categoria '{{$categoria->nombre}}' ?"><span class="glyphicon glyphicon-trash"></span></a>
			  </div>
		  </h4>
		</div>
		<div id="collapse_{{$categoria->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		  <div class="panel-body">
			@if((count($categoria->subcategorias) > 0)||(count($categoria->variables) > 0))
		  	  
		      <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			  	<?php $tab_status = 'class="active"' ?>
			  	@if(count($categoria->subcategorias) > 0)
			    	<li role="presentation" {{$tab_status}}><a href="#subcategorias_{{$categoria->id}}" aria-controls="subcategorias_{{$categoria->id}}" role="tab" data-toggle="tab">Subcategorias</a></li>
			  		<?php $tab_status = '' ?>
			    @endif
			    @if(count($categoria->variables) > 0)
			    	<li role="presentation" {{$tab_status}}><a href="#variables_{{$categoria->id}}" aria-controls="variables_{{$categoria->id}}" role="tab" data-toggle="tab">Variables</a></li>
			    @endif
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
			  	<?php $panel_status = 'active' ?>
			  	@if(count($categoria->subcategorias) > 0)
			    	<div role="tabpanel" class="tab-pane {{$panel_status}}" id="subcategorias_{{$categoria->id}}">
						<div class="panel-group" id="accordion_{{$categoria->id}}" role="tablist" aria-multiselectable="true">
							@foreach($categoria->subcategorias as $subcategoria)
								@include('categorias_variables.panel',['categoria' => $subcategoria, 'grupo' => 'accordion_'.$categoria->id])
							@endforeach
						</div>
			    	</div>
			  		<?php $panel_status = '' ?>
			    @endif
			    @if(count($categoria->variables) > 0)
			    	<div role="tabpanel" class="tab-pane {{$panel_status}}" id="variables_{{$categoria->id}}">
			    		<div class="col-md-10 col-md-offset-1">
			    			@foreach($categoria->variables as $variable)
			    			<div class="row">
								<div class="col-md-10">
									{{ $variable->codigo }} - {{ $variable->nombre }}
								</div>
								<div class="col-md-2">
									<a title="Editar variable" href="{{ action('VariableController@edit', [$categoria->id, $variable->id]) }}" data-toggle="tooltip" data-placement="top">
										<span class="glyphicon glyphicon-pencil"></span>
									</a>
									<a title="Eliminar variable" href="{{ action('VariableController@destroy', [$categoria->id, $variable->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar variable" data-confirm="¿Estas seguro que desea eliminar la variable '{{$variable->nombre}}' ?"><span class="glyphicon glyphicon-trash"></span></a>
								</div>
							</div>
			    			@endforeach
						</div>
			    	</div>
			    @endif
			  </div>
			@endif
		  </div>
		</div>
	</div>