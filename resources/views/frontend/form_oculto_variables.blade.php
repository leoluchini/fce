{!! Form::open(array('action' => ['PublicoController@variables'], 'method' => 'POST', 'style' => 'display:none', 'id' => 'datos_consulta')) !!}
  <input type="hidden" name="tipo_busqueda" value="{{$filtros['tipo_busqueda']}}">
  <input type="hidden" name="tipo_zona" value="{{$filtros['tipo_zona']}}">
  @foreach($filtros[$filtros['tipo_zona']] as $valor)
    <input type="hidden" name="regiones[{{$valor}}]" value="{{$valor}}">
  @endforeach
  @foreach($filtros['variable_id'] as $valor)
    <input type="hidden" name="variable_id[{{$valor}}]" value="{{$valor}}">
  @endforeach
  @foreach($filtros['periodo'] as $valor)
    <input type="hidden" name="periodo[{{$valor}}]" value="{{$valor}}">
  @endforeach
  <input type="hidden" name="tipo_frecuencia" value="{{$filtros['tipo_frecuencia']}}">
  @if($filtros['tipo_frecuencia'] != 'anual')
    @foreach($filtros[$filtros['tipo_frecuencia']] as $valor)
      <input type="hidden" name="frecuencias[{{$valor}}]" value="{{$valor}}">
    @endforeach
  @endif
{!! Form::close() !!}