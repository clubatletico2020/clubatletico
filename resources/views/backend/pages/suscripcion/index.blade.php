@extends('layouts/backend')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{asset('backend/css/modulos/eventos/tabla_modal_ver.css')}}">
@endsection

@section('content')
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">Gestión Suscripciones</h5>
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
                <h3 class="card-title">Listado</h3>
              </div>

              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th style="width: 120px">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="body-suscripcion">
                  @foreach($suscripciones as $suscripcion)
                    <tr>
                      <td>{{$suscripcion->nombre}}</td>
                      <td>
                          {{$suscripcion->correo}}
                      </td>
                      <td align="center">                       
                        <button class="btn btn-outline-warning btn-xs" onclick="Edit(this.id)" id="{{$suscripcion->id}}" ><i class="fa fa-edit"></i></button>
                        <button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id)" id="{{$suscripcion->id}}"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>

    </section>

  </div>

@include('backend/pages/suscripcion/modal')

@endsection

@section('js')
	<script type="text/javascript" src="{{asset('backend/js/ajax-suscripcion.js')}}"></script>
@endsection
