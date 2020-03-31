@extends('layouts/backend')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">Gestión Usuario</h5>
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
                <h3 class="card-title">Nuevo Usuario</h3>
              </div>
              <div class="card-body">
                <form id="formUsuario">
                  @csrf
              	  <div class="row">
                    <div class="col col-12 col-lg-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control form-control-sm">
                      </div>
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Correo electronico</label>
                        <input name="email" type="email" class="form-control form-control-sm">
                      </div>
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Contraseña</label>
                        <input name="password" type="password" class="form-control form-control-sm pass">
                      </div>
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Repetir Contraseña</label>
                        <input type="password" class="form-control form-control-sm repetir">
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    @foreach($roles as $role)
                      <div class="col col-12 col-lg-4">
                        <div class="form-group">
                          <label>
                            <input class="@if($role->special == 'all-access') access @elseif($role->special == 'no-access') noaccess @else free @endif" type="checkbox" name="roles[]" value="{{$role->id}}">&nbsp; {{$role->name}}
                          </label>
                        </div>
                      </div>
                    @endforeach
                    </div>

                    <div class="row">
                    @foreach($permisos as $permiso)
                      <div class="col col-12 col-lg-4">
                        <div class="form-group">
                          <label>
                            <input class="free" type="checkbox" name="permissions[]" value="{{ $permiso->id}}">&nbsp; {{$permiso->name}}
                          </label>
                        </div>
                      </div>
                    @endforeach
                    </div>
                  <div class="row">
                    <div class="col-12 text-right">
                      <button type="submit" class="btn btn-outline-success btn-sm añadir-user" disabled=""><i class="fa fa-plus"></i> Añadir Usuario</button>
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
                      <th>Correo</th>
                      <th style="width: 120px">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="body-usuario">
                        @forelse($usuarios as $usuario)
                    <tr>
                      <td>{{$usuario->name}}</td>
                      <td>
                          {{$usuario->email}}
                      </td>
                      <td align="center">
                            <a href="{{route('usuario.edit',$usuario->id)}}"><button class="btn btn-outline-warning btn-xs"style="margin: 2px;"><i class="fa fa-edit"></i></button></a>

                            <button class="btn btn-outline-info btn-xs" onclick="Pass(this.id)" id="{{$usuario->id}}" style="margin: 2px;"><i class="fa fa-key"></i></button>

                            <button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id)" id="{{$usuario->id}}"><i class="fa fa-trash" style="margin: 2px;"></i></button>
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

@include('backend/pages/usuario/modal')

@endsection

@section('js')

	<script type="text/javascript" src="{{asset('backend/js/ajax-usuario.js')}}"></script>
@endsection
