@foreach($categorias as $categoria)
	<tr>
		<td>{{$categoria->nombre}}</td>
		<td>{{$categoria->descripcion}}</td>
		<td><a href="{{ action('PublicacionController@index', [$categoria->id]) }}">{{count($categoria->publicaciones)}}</a></td>
		<td class="text-right">
			<a title="Editar categoria" href="{{ action('CategoriaController@edit', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-pencil-4"></span></a>
			&nbsp;<a title="Agregar publicaci&oacute;n" href="{{ action('PublicacionController@create', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-plus"></span></a>&nbsp;
			<a title="Eliminar categoria" href="{{ action('CategoriaController@destroy', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar categoria" data-confirm="¿Estas seguro que desea eliminar la categoria '{{$categoria->nombre}}' ?"><span class="icon-trash-4"></span></a>	
		</td>
	</tr>
@endforeach
