@extends('layouts.app_back')

@section('content')
  <div class="container">
  	@include('generic.breadcrumb_multiple',['modulo' => 'Datos del lote', 'enlaces' => array('Subir indicadores' => action('LecturaIndicadorController@index'), 'Lote' => action('LecturaIndicadorController@show', $lote->id))])
		@include('lectura_indicadores.navs')
		<div class="row">
   	<div class="col-xs-12"> 
   			<h4>Mostrando {{$zonas->count()}} resultados de un total de {{$zonas->total()}}</h4>
				<table id="tabla_lote" class="table table-condensed">
				    <thead>
				      <tr style="background-color:white;">
				        <th>Código</th>
				        <th>Nombre</th>
				        <th>Descripción</th>
				      </tr>
				    </thead>
				    <tbody>
			        @foreach( $zonas as $zona )
			          <tr>
		              <td>{{ $zona->codigo }}</td>
		              <td>{{ $zona->nombre }}</td>
		              <td>{{ $zona->descripcion }}</td>
			          </tr>
				      @endforeach
				    </tbody>
			  	</table>
		  	{{ $zonas->render() }}
		</div>
	</div>
</div>
@endsection
