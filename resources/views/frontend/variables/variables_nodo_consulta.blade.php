<li  class="subcategoria">
    <label class="tree-toggler nav-header"><span class="icon-plus"></span>{{$categoria->nombre}}</label>
    <ul class="nav nav-list tree indice_variables">
        @foreach($categoria->variables as $variable)
            <li><a href="#" class="selector_variable" data-id="{{$variable->id}}" data-nombre="{{$variable->nombre}}" data-relacionados="{{$variable->tema ? 'true' : 'false'}}">{{ $variable->nombre }}</a></li>
        @endforeach
        @foreach($categoria->subcategorias as $subcategoria)
            @include('frontend.variables.variables_nodo_consulta',['categoria' => $subcategoria])
        @endforeach
    </ul>
</li>