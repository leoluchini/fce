@foreach($fuentes as $fuente)
	<tr>
		<td>{{$fuente->sigla}}</td>
		<td>{{$fuente->nombre}}</td>
		<td class="text-right">
			<a title="Editar fuente" href="{{ action('FuenteController@edit', [$frecuencia->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
			&nbsp;
			<a title="Eliminar fuente" href="{{ action('FuenteController@destroy', [$frecuencia->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar fuente" data-confirm="¿Estas seguro que desea eliminar la fuente '{{$fuente->nombre}}' ?"><span class="glyphicon glyphicon-trash"></span></a>	
		</td>
	</tr>
@endforeach
