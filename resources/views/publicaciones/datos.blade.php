@foreach($publicaciones as $publicacion)
	<tr>
		<td><a href="{{ action('PublicacionController@ver_archivo', [$publicacion->id]) }}" target="_blank">{{$publicacion->nombre}}</a></td>
		<td>{{$publicacion->descripcion}}</td>
		<td>{{$publicacion->anio_publicacion}}</td>
		<td class="text-right">
			<a title="Editar publicacion" href="{{ action('PublicacionController@edit', [$categoria->id, $publicacion->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
			&nbsp;
			<a title="Descargar" href="{{ action('PublicacionController@descargar_archivo', [$publicacion->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-download"></span></a>	
			&nbsp;
			<a title="Eliminar publicacion" href="{{ action('PublicacionController@destroy', [$categoria->id, $publicacion->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar publicacion" data-confirm="¿Estas seguro que desea eliminar la publicacion '{{$publicacion->nombre}}' ?"><span class="glyphicon glyphicon-trash"></span></a>	
		</td>
	</tr>
@endforeach