@extends('layouts/backend')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2"> 
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">Gestión Directorio</h5>
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
                <h3 class="card-title">Personal</h3>
              </div>
              <div class="card-body">
                <form id="formDirectorio" enctype="multipart/form-data">
                  @csrf
              	  <div class="row">
                    <div class="col col-12 col-lg-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control form-control-sm" required="" maxlength="33">
                      </div>
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Cargo</label>
                        <input type="text" name="cargo" class="form-control form-control-sm" required="" maxlength="40">
                      </div>
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Establecimiento</label>
                        <input type="text" name="establecimiento" class="form-control form-control-sm" required="" maxlength="35">
                      </div>
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Imagen</label>
                        <input name="imagen" type="file" class="form-control form-control-sm" placeholder="Seleccionar Imagen" required="">
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
                      <th>Estado</th>
                      <th style="width: 120px">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="body-directorio">
                    @forelse($directorios as $directorio)
                    <tr>                     
                      <td>{{$directorio->nombre}}</td>
                      <td>                        
                          {{$directorio->estado->estado}}                        
                      </td>
                      <td align="center">
                        <button class="btn btn-outline-primary btn-xs" onclick="View(this.id)" id="{{$directorio->id}}"><i class="fa fa-eye"></i></button>
                        <button class="btn btn-outline-warning btn-xs" onclick="Edit(this.id)" id="{{$directorio->id}}"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id)" id="{{$directorio->id}}"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>

                    @empty
                      <tr><b>Sin Información</b></tr>
                    @endforelse                   
                  </tbody>
                </table>
              </div>

            </div>            
          </div>          
        </div>              
        
    </section>

  </div>

@include('backend/pages/directorio/modal')

@endsection

@section('js')
	<script type="text/javascript" src="{{asset('backend/js/ajax-directorio.js')}}"></script>
@endsection