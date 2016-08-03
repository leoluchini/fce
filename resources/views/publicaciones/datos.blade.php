@foreach($publicaciones as $publicacion)
	<tr>
		<td>{{$publicacion->nombre}}</td>
		<td>{{$publicacion->descripcion}}</td>
		<td>{{$publicacion->anio_publicacion}}</td>
		<td class="text-right">
			<a title="Editar publicacion" href="{{ action('PublicacionController@edit', [$publicacion->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
			&nbsp;
			<a title="Eliminar publicacion" href="{{ action('PublicacionController@destroy', [$publicacion->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar publicacion" data-confirm="¿Estas seguro que desea eliminar la publicacion '{{$publicacion->nombre}}' ?"><span class="glyphicon glyphicon-trash"></span></a>	
		</td>
	</tr>
@endforeach