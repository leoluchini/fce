<li class="subcategoria">
    <label class="tree-toggler nav-header"><span class="icon-plus"></span>{{ucfirst($tema->nombre)}}</label>
    <ul class="nav nav-list tree indice_indicadores">
        @foreach($tema->indicadores as $indicador)
            <li><a href="#" class="selector_indicador" data-id="{{$indicador->id}}" data-nombre="{{$indicador->nombre}}" data-relacionados="true">{{ $indicador->nombre }}</a></li>
        @endforeach
    </ul>
</li>