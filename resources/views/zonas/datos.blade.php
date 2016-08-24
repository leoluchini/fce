@foreach($zonas as $zona)
	<tr>
		<td>{{$zona->codigo}}</td>
		<td>{{$zona->nombre}}</td>
		<td class="text-right">
			<a title="Editar zona geografica" href="{{ action('ZonaGeograficaController@edit', [$zona->tipo, $zona->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
			&nbsp;
			<a title="Eliminar zona geografica" href="{{ action('ZonaGeograficaController@destroy', [$zona->tipo, $zona->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar zona geografica" data-confirm="¿Estas seguro que desea eliminar la zona geografica '{{$zona->nombre}}' ?"><span class="glyphicon glyphicon-trash"></span></a>	
		</td>
	</tr>
@endforeach
