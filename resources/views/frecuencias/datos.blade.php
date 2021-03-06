@foreach($frecuencias as $frecuencia)
	<tr>
		<td>{{$frecuencia->tipo}}</td>
		<td>{{$frecuencia->codigo}}</td>
		<td>{{$frecuencia->nombre}}</td>
		<td class="text-right">
			<a title="Editar frecuencia" href="{{ action('FrecuenciaController@edit', [$frecuencia->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-edit"></span></a>
			&nbsp;
			<a title="Eliminar frecuencia" href="{{ action('FrecuenciaController@destroy', [$frecuencia->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar frecuencia" data-confirm="¿Estas seguro que desea eliminar la frecuencia '{{$frecuencia->nombre}}' ?"><span class="icon-trash-4"></span></a>	
		</td>
	</tr>
@endforeach
