	<div class="panel panel-default">
		

		<!-- CATEGORIA -->
		<div class="panel-heading" role="tab" >
		  <h4 class="panel-title">
		    <a class="pull-left" role="button" href="{{ action('VariableController@index', [$categoria->id]) }}" >
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
	</div>