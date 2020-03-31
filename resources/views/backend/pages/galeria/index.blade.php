@extends('layouts/backend')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">Gestión Galerías</h5>
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
                <h3 class="card-title">Galerías</h3>
              </div>
              <div class="card-body">
                <form id="formGaleria" enctype="multipart/form-data">
                  @csrf
              	  <div class="row">
                    <div class="col col-12 col-lg-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control form-control-sm" required="" maxlength="20">
                      </div>
                    </div>
                    <div class="col col-12 col-lg-6">
                      <div class="form-group">
                        <label>Imagen</label>
                        <input name="imagen[]" type="file" class="form-control form-control-sm" multiple required="">
                      </div>                      
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-12 text-right">
                      <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i> Añadir</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>            
          </div>          
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>                      
                      <th>Nombre</th>
                      <th>Cantidad</th>
                      <th style="width: 120px">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="body-galeria">
                        @forelse($galerias as $galeria)
                    <tr>                     
                      <td>{{$galeria->nombre}}</td>
                      <td>                        
                          {{count($galeria->imagen)}}                    
                      </td>
                      <td align="center">
                        <div class="row">
                          <div class="col-6">
                            <a href="{{route('galeria.edit',$galeria->id)}}"><button class="btn btn-outline-warning btn-xs"><i class="fa fa-edit"></i></button></a>
                          </div>
                          <div class="col-6">
                            <button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id)" id="{{$galeria->id}}"><i class="fa fa-trash"></i></button>
                          </div>                          
                        </div>                       
                      </td>
                    </tr>
                    @empty
                      <tr><td colspan="3"><b>Sin Información</b></td></tr>
                    @endforelse             
                  </tbody>
                </table>
              </div>
            </div>            
          </div>          
        </div>              
        
    </section>

  </div>

@include('backend/pages/galeria/modal')

@endsection

@section('js')
	<script type="text/javascript" src="{{asset('backend/js/ajax-galeria.js')}}"></script>
@endsection