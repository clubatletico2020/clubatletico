@extends('layouts/backend')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">Gestión Comentarios</h5>
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
                <h3 class="card-title">COMENTACION CAPACITACIÓN - <small>""</small></h3>
                <input type="integer" class="id" value="{{$capacitacion->id}}" hidden="">
              </div>

              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>                      
                      <th>Nombre</th>
                      <th>Comentario</th>
                      <th>Fecha</th>
                      <th style="width: 50px">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="body-comentario">
                    @forelse($comentarios as $comentario)
                    <tr>                     
                      <td>{{$comentario->nombre}}</td>
                      <td>{{$comentario->comentario}}</td>
                      <td>{{$comentario->created_at}}</td>                      
                      <td align="center">
                        <button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id) " id="{{$comentario->id}}"><i class="fa fa-trash"></i></button>
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

@include('backend/pages/capacitacion/modalComentario')

@endsection

@section('js')
  <script type="text/javascript" src="{{asset('backend/js/ajax-comentario.js')}}"></script>
@endsection

