<ol class="breadcrumb">
  <li><a href="{{url('/administracion')}}">Men&uacute; administraci&oacute;n</a></li>
  @foreach($enlaces as $label => $link)
  <li><a href="{{$link}}">{{$label}}</a></li>
  @endforeach
  <li class="active">{{$modulo}}</li>
</ol>