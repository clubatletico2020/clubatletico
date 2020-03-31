@extends('layouts/backend')

@section('css')
<link rel="stylesheet" href="{{asset('backend/css/clockpicker.css')}}">
@endsection

@section('content')
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">Gestión Contacto</h5>
          </div>
        </div>
      </div>
    </div>

    <section class="content">

      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Información Contacto</h3>
              </div>
              <div class="card-body">
              	<form id="formContacto">
                  @csrf
                  <input type="hidden" value="1" name="save_code">
                  <div class="row">
                    <div class="col col-12 col-lg-5">
                      <div class="form-group">
                        <label>Correo electronico</label>
                        <input type="text" name="correo_contacto" class="form-control form-control-sm" value="@if(!empty($contacto->correo_contacto)){{$contacto->correo_contacto}}@endif">
                      </div>
                    </div>
                    <div class="col col-12 col-lg-1">
                      <div class="form-group">
                        <label>Prefijo</label>
                        <select class="form-control form-control-sm" name="prefijo_id">
                          @foreach($prefijos as $prefijo)
                            @if(isset($contacto->prefijo_id))
                              @if($contacto->prefijo_id == $prefijo->id)
                                <option value="{{$prefijo->id}}" selected="">{{$prefijo->nombre}}</option>
                              @else
                                <option value="{{$prefijo->id}}">{{$prefijo->nombre}}</option>
                              @endif
                            @else
                              <option value="{{$prefijo->id}}">{{$prefijo->nombre}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" name="telefono" class="form-control form-control-sm"
                        value="@if(!empty($contacto->telefono)){{$contacto->telefono}}@endif" maxlength="7">
                      </div>
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Celular</label>
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend ">
                            <div class="input-group-text ">+56 9</div>
                          </div>
                        <input type="text" name="celular" class="form-control form-control-sm" value="@if(!empty($contacto->celular)){{$contacto->celular}}@endif" maxlength="8">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-right">
                      <button type="submit" class="btn btn-outline-success btn-sm btn-contacto-info" id="1"><i class="fa fa-spinner"></i> Actualizar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ubicación</h3>
              </div>
              <div class="card-body">
                <form id="formUbicacion">
                  @csrf
                  <div class="row">
                    <input type="text" value="2" name="save_code" hidden="">
                    <div class="col-12">
                      <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" name="direccion" class="form-control form-control-sm" value="@if(!empty($contacto->direccion)){{$contacto->direccion}}@endif">
                      </div>
                    </div>
                    <div class="col-12">

                      <div class="form-group">
                        <label>Mapa</label>
                        <textarea type="text" name="link_mapa" class="form-control form-control-sm">@if(!empty($contacto->link_mapa)){{$contacto->link_mapa}}@endif</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-right">
                      <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-spinner"></i> Actualizar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>

@endsection

@section('js')
  <script type="text/javascript" src="{{asset('backend/js/clockpicker.js')}}"></script>
<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>
	<script type="text/javascript" src="{{asset('backend/js/ajax-contacto.js')}}"></script>
@endsection
