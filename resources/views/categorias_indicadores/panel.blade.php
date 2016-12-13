	<div class="panel panel-default">
		

		<!-- CATEGORIA -->
		<div class="panel-heading" role="tab">
		  <h4 class="panel-title">
		    <a class="pull-left" role="button" href="{{ action('IndicadorController@index', [$categoria->id]) }}" >
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

	</div>