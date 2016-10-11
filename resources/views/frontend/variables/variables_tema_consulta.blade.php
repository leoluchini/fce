<li>
    <label class="tree-toggler nav-header">{{ucfirst($tema->nombre)}}</label>
    <ul class="nav nav-list tree">
        @foreach($tema->variables as $variable)
            <li><a href="#" class="selector_variable" data-id="{{$variable->id}}" data-nombre="{{$variable->nombre}}">{{ $variable->nombre }}</a></li>
        @endforeach
    </ul>
</li>