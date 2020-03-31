@extends('layouts/backend')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">Edición Galería</h5>
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
                <h3 class="card-title">Información</h3>
              </div>
              <div class="row">
                <div class="col col-12 col-lg-6">
                  <form id="formNombre">
                    @csrf
                    @method('PUT')
                    <div class="card-body">                
                    	<div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control form-control-sm" value="{{$galeria->nombre}}" required="" maxlength="20">
                            <input type="text" name="id" value="{{$galeria->id}}" hidden="" required="">
                          </div>
                        </div>                                        
                      </div>
                    </div>                  
                    <div class="row card-footer">
                      <div class="col-12 text-right">
                        <button type="submit" class="btn btn-outline-success btn-sm btn-nombre" id="{{$galeria->id}}"><i class="fas fa-spinner"></i> Actualizar</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col col-12 col-lg-6">
                  <form id="formImagenes" enctype="multipart/form-data">
                    @csrf
                      <div class="card-body">                
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">
                                <label>Nuevas imagenes</label>
                                <input type="text" name="id" hidden="" value="{{$galeria->id}}">
                                <input name="imagen[]" type="file" class="form-control form-control-sm" multiple required="">
                              </div>                      
                            </div>                                        
                          </div>
                      </div>                  
                      <div class="row card-footer">
                        <div class="col-12 text-right">
                          <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-upload"></i> Cargar imagenes</button>
                        </div>
                      </div>
                  </form>
                </div>
              </div>
            </div>            
          </div>          
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Imagenes</h3>
              </div>
              <div class="card-body">             
                <div class="row body-imagenes">
                   @foreach($galeria->imagen as $imagen)
                     <div class="col col-6 col-lg-2" align="center">
                      <img src="{{asset('storage/'.$imagen->url)}}" width="150px" height="150px" class="rounded" width="100%">
                      <div class="row m-2">
                        <div class="col-12">
                         <button class="btn btn-outline-danger btn-block btn-xs" onclick="deleteConfirm(this.id)" id="{{$imagen->id}}"><i class="fa fa-trash" ></i></button>
                        </div>
                      </div>
                     </div>
                   @endforeach
                </div>              
              </div>              
            </div>            
          </div>          
        </div>              
         
    </section>

  </div>

@include('backend/pages/galeria/modal')

@endsection

@section('js')
	<script type="text/javascript" src="{{asset('backend/js/ajax-imagen-galeria.js')}}"></script>
@endsection