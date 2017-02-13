<div class="modal fade" id="modal_consulta" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title">
            <span class="icon-th-list-2"></span>
            Indice de variables
        </h2>
      </div>

      <div class="modal-body">
          <div class="col-md-12">
            <p id="texto_seleccion_arbol" data-default="Seleccione las variables que desee consultar">
              Seleccione las variables que desee consultar
            </p>
            <div class="row">
              <div class="col-md-6">
                <h3>Por Categorias</h3>
                <div class="well well_fce">
                  <div style="overflow-y: scroll; overflow-x: hidden; height: 200px;">
                      <ul class="nav nav-list">
                          @foreach($categorias as $categoria)
                            @include('frontend.variables.variables_nodo_consulta',['categoria' => $categoria])
                          @endforeach
                      </ul>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <h3>Por Temas</h3>
                <div class="well well_fce">
                  <div style="overflow-y: scroll; overflow-x: hidden; height: 200px;" id="arbol_temas_variables">
                      <ul class="nav nav-list">
                          @foreach($temas as $tema)
                            @include('frontend.variables.variables_tema_consulta',['categoria' => $categoria])
                          @endforeach
                          @if(count($variables_sin_tema) > 0)
                            <li class="subcategoria">
                              <label class="tree-toggler nav-header"><span class="icon-plus"></span>Más Variables</label>
                              <ul class="nav nav-list tree indice_variables">
                                  @foreach($variables_sin_tema as $variable)
                                      <li><a href="#" class="selector_variable" data-id="{{$variable->id}}" data-nombre="{{$variable->nombre}}" data-relacionados="false">{{ $variable->nombre }}</a></li>
                                  @endforeach
                              </ul>
                            </li>
                          @endif
                      </ul>
                  </div>
                </div>
              </div>

            </div>
          </div>
      </div>
      <div class="clearfix"></div>

      <div class="modal-footer">
        <center>
          <div class="header_izquierda">
            <a href="http://www.econo.unlp.edu.ar/laboratorio" target="_blank">
             {!! Html::image('images/menu_horizontal_LAB.png', 'Laboratorio de Desarrollo Sectorial y Territorial', ['class'=>''])!!}
            </a>
            <a href="http://www.econo.unlp.edu.ar" target="_blank" class="border_left">
              {!! Html::image('images/menu_horizontal_FCE.png', 'Facultad de Ciencias Econ&oacute;micas', ['class'=>''])!!}
            </a>
          </div>
        </center>
          <div class="row">
            <div class="col-md-2 col-md-offset-10">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>