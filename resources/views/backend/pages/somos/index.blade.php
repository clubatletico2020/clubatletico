@extends('layouts/backend')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">Gestión Quiénes Somos</h5>
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
                <h3 class="card-title">Información - <small>Llenar los campos para ser reflejados en la web.</small></h3>
              </div>
              <div class="card-body">
                <form id="formSomos" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Descripción de la fundación</label>
                        <textarea name="fundacion" class="textarea" rows="3" placeholder="Texto ...">@if(!empty($somos->vision)){{$somos->mision}} @endif</textarea>
                      </div>
                      <div class="form-group">
                        <label>Imagen de la fundación</label>
                        <input name="imagen" type="file" class="form-control imagen_somos" placeholder="Seleccionar Imagen">
                      </div>
                      <div class="form-group">
                        <label>Misión</label>
                        <textarea name="mision" class="form-control" rows="3" placeholder="Texto ...">@if(!empty($somos->vision)){{$somos->mision}} @endif</textarea>
                      </div>
                      <div class="form-group">
                        <label>Visión</label>
                        <textarea name="vision" class="form-control" rows="3" placeholder="Texto ...">@if(!empty($somos->vision)){{$somos->vision}}@endif</textarea>
                      </div>
                    </div>
                    <div class="col-sm-6 text-center m-auto" >
                      <div class="form-group body-img">
                        @if(!empty($somos->url_fundacion))
                          <img class="w-50 rounded" src="{{asset('storage/'.$somos->url_fundacion)}}" align="img">
                        @endif
                      </div>
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-12 text-right body-button body-button-delete">
                        <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-spinner"></i> Actualizar</button>
                      @if(!empty($somos->url_fundacion))
                        <button type="button" class="btn btn-outline-danger btn-sm btn-delete-imagen" onclick="DeleteImagen()"><i class="fa fa-trash"></i> Eliminar Imagen</button>
                      @endif
                    </div>
                  </div>
                </form>
              </div>
            </div>            
          </div>          
        </div>       
      </div> 

      <!-- Valores -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-6">
                    <h3 class="card-title">Valores</h3>
                  </div>
                  <div class="col-6 text-right">
                    <button type="submit" id="boton_nuevo_valor" class="btn btn-outline-warning btn-sm"><i class="fa fa-plus"></i> Nuevo</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form id="formSomosItemsValores">
                  @csrf
                  <div class="row">
                    <!-- <div class="col-sm-12 col-md-12 col-lg-12 wrapper_valores" style="border:1px solid black;"> -->
                      <!-- text input -->
                      <div class="col-sm-2 col-md-2 col-lg-2 text-right form-group" style="border:0px solid black;">
                          <label>Descripción</label>
                      </div>
                      <div class="col-sm-7 col-md-7 col-lg-7" style="border:0px solid black;">
                          <input type="text" name="descripcion_valor[]" class="form-control" id="" data-con_boton_eliminar="no">
                      </div>
                      <div class="col-sm-3 col-md-3 col-lg-3" style="border:0px solid black;">
                          <!-- 
                          <div style="padding:4px 0px 4px 0px;">
                            <button type="button" class="btn btn-outline-danger btn-sm btn-delete-imagen"><i class="fa fa-trash"></i> Eliminar</button>
                          </div>
                           -->
                      </div>
                    <!-- </div> -->
                  </div>
                  <div class="wrapper_valores"></div>
                  <!-- Contenedor donde se van creado los campos de texto de las "Descripciones de valor" -->
                  @foreach($valores as $valor)
                    <div class="row">
                      <div class="col-sm-2 col-md-2 col-lg-2 text-right form-group" style="border:0px solid black;">
                         <label>Descripción</label>
                      </div>
                      <div class="col-sm-7 col-md-7 col-lg-7" style="border:0px solid black;">
                          <input type="text" name="descripcion_valor" class="form-control" value="{{$valor->descripcion}}" data-con_boton_eliminar="si">
                      </div>
                      <div class="col-sm-3 col-md-3 col-lg-3" style="border:0px solid black;">
                          <div style="padding:4px 0px 4px 0px;border:0px solid black;">
                            <button type="button" class="btn btn-outline-danger btn-sm btn-delete-imagen remove_field"><i class="fa fa-trash"></i> Eliminar</button>
                          </div>
                      </div>
                    </div>
                  @endforeach    
                  
                  <div class="row">
                    <div class="col-12 text-right body-button body-button-delete">
                        <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-spinner"></i> Actualizar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>            
          </div>          
        </div>       
      </div> 
      <!-- fin -->
    </section>
    <!-- /.content -->
  </div>

  @include('backend/pages/somos/modal')

@endsection

@section('js')
	<script type="text/javascript" src="{{asset('backend/js/ajax-somos-item.js')}}"></script>
  <script type="text/javascript" src="{{asset('backend/js/ajax-somos.js')}}"></script>
@endsection