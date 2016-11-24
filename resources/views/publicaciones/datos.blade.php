@foreach($publicaciones as $publicacion)
	<tr>
		<td><a href="{{ action('PublicacionController@ver_archivo', [$publicacion->id]) }}" target="_blank">{{$publicacion->nombre}}</a></td>
		<td>{{$publicacion->descripcion}}</td>
		<td>{{$publicacion->anio_publicacion}}</td>
		<td class="text-right">
			<a title="Editar" href="{{ action('PublicacionController@edit', [$categoria->id, $publicacion->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-pencil-4"></span></a>
			&nbsp;<a title="Descargar" href="{{ action('PublicacionController@descargar_archivo', [$publicacion->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-download-outline"></span></a>	
			&nbsp;<a title="Visualizar" href="{{ action('PublicacionController@ver_archivo', [$publicacion->id]) }}" data-toggle="tooltip" data-placement="top" target="_blank"><span class="icon-book-open"></span></a>	
			&nbsp;<a title="Eliminar" href="{{ action('PublicacionController@destroy', [$categoria->id, $publicacion->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar publicacion" data-confirm="¿Estas seguro que desea eliminar la publicacion '{{$publicacion->nombre}}' ?"><span class="icon-trash-4"></a>	
		</td>
	</tr>
@endforeach