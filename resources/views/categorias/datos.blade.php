@foreach($categorias as $categoria)
	<tr>
		<td>{{$categoria->nombre}}</td>
		<td>{{$categoria->descripcion}}</td>
		<td class="text-right">
			<a title="Editar categoria" href="{{ action('CategoriaController@edit', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
			&nbsp;<a title="Nueva Publicacion" href="" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>&nbsp;
			<a title="Eliminar categoria" href="{{ action('CategoriaController@destroy', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar categoria" data-confirm="¿Estas seguro que desea eliminar la categoria '{{$categoria->nombre}}' ?"><span class="glyphicon glyphicon-trash"></span></a>	
		</td>
	</tr>
@endforeach
