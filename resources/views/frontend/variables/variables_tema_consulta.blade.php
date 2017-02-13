<li class="subcategoria">
    <label class="tree-toggler nav-header"><span class="icon-plus"></span>{{ucfirst($tema->nombre)}}</label>
    <ul class="nav nav-list tree indice_variables">
        @foreach($tema->variables as $variable)
            <li><a href="#" class="selector_variable" data-id="{{$variable->id}}" data-nombre="{{$variable->nombre}}" data-relacionados="true">{{ $variable->nombre }}</a></li>
        @endforeach
    </ul>
</li>