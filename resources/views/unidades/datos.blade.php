@foreach($unidades as $unidad)
	<tr>
		<td>{{$unidad->codigo}}</td>
		<td>{{$unidad->nombre}}</td>
		<td>{{$unidad->descripcion}}</td>
		<td class="text-right">
			<a title="Editar unidad" href="{{ action('UnidadController@edit', [$unidad->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
			&nbsp;
			<a title="Eliminar unidad" href="{{ action('UnidadController@destroy', [$unidad->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar unidad" data-confirm="¿Estas seguro que desea eliminar la unidad de medida '{{$unidad->nombre}}' ?"><span class="glyphicon glyphicon-trash"></span></a>	
		</td>
	</tr>
@endforeach
