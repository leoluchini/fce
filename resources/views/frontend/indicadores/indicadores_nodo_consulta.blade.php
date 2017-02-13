<li  class="subcategoria">
    <label class="tree-toggler nav-header"><span class="icon-plus"></span>{{$categoria->nombre}}</label>
    <ul class="nav nav-list tree indice_indicadores">
        @foreach($categoria->indicadores as $indicador)
            <li><a href="#" class="selector_indicador" data-id="{{$indicador->id}}" data-nombre="{{$indicador->nombre}}" data-relacionados="{{$indicador->tema ? 'true' : 'false'}}">{{ $indicador->nombre }}</a></li>
        @endforeach
        @foreach($categoria->subcategorias as $subcategoria)
            @include('frontend.indicadores.indicadores_nodo_consulta',['categoria' => $subcategoria])
        @endforeach
    </ul>
</li>