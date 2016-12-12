<div class="row">
  <div class="col-xs-12">
  <div class="page-header">
    <div class="pull-right">
      <div class="btn-group">
          @if($lote->estado == $lote::ESTADO_FINALIZADO)
            <a href="{{ route('administracion.lote.aceptar', $lote->id)}}" data-titulo="Aceptar Lote" data-mensaje="¿Estas seguro que desea aceptar los datos del lote '{{$lote->id}}' ?" data-toggle="tooltip" data-placement="top" title="Aceptar lote" class="confirm_modal"><span class="icon-thumbs-up-1"></span></a>
          @endif
          @if($lote->estado == $lote::ESTADO_ACEPTADO)
            <a href="{{ route('administracion.lote.desactivar', $lote->id)}}" data-titulo="Desactivar Lote" data-mensaje="¿Estas seguro que desea desactivar los datos del lote '{{$lote->id}}' ?" data-toggle="tooltip" data-placement="top" title="Desactivar lote" class="confirm_modal"><span class="icon-thumbs-down-1"></span></a>
          @endif
        <a href="{{ route('administracion.lectura.destroy', $lote->id)}}" data-method="delete" data-title="Eliminar Lote" data-confirm="¿Estas seguro que desea eliminar los datos del lote '{{$lote->id}}' ?" data-toggle="tooltip" data-placement="top" title="Borar lote"><span class="icon-trash-4"></span></a>
      </div>
    </div>
    <h1>
      <span class="icon-box-2"></span>
      Lote {{$lote->id}}
      <small>{{ $lote->estadoActual }}</small>
    </h1>
  </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills nav-justified altura">
      <li class="nav-item {{ Route::getCurrentRoute()->getName() == 'lote-indicadores.categorias' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lote-indicadores.categorias', $lote->id)}}">
        	Categorias
        	<span class="badge">{!! $lote->categorias->count() !!}</span>
        </a>
      </li>
      
      <li class="nav-item {{ Route::getCurrentRoute()->getName() == 'lote-indicadores.indicadores' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lote-indicadores.indicadores', $lote->id)}}">
        	Indicadores
        	<span class="badge">{!! $lote->indicadores->count() !!}</span>
        </a>
      </li>  

      <li class="nav-item {{ Route::getCurrentRoute()->getName() == 'lote-indicadores.unidades' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lote-indicadores.unidades', $lote->id)}}">
        	Unidades de medida
        	<span class="badge">{!! $lote->unidades->count() !!}</span>
        </a>
      </li>  

      <li class="nav-item {{ Route::getCurrentRoute()->getName() == 'lote-indicadores.zonas' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lote-indicadores.zonas', $lote->id)}}">
        	Zonas geográficas
        	<span class="badge">{!! $lote->zonas->count() !!}</span>
        </a>
      </li>  

      <li class="nav-item {{ Route::getCurrentRoute()->getName() == 'lote-indicadores.fuentes' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lote-indicadores.fuentes', $lote->id)}}">
        	Fuentes
        	<span class="badge">{!! $lote->fuentes->count() !!}</span>
        </a>
      </li>

      <li class="nav-item {{ Route::getCurrentRoute()->getName() == 'lote-indicadores.datos' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lote-indicadores.datos', $lote->id)}}">
        	Datos
        	<span class="badge">{!! $lote->datosCount !!}</span>
        </a>
      </li>
      
    </ul>
  </div>
</div>
