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
                <h3 class="card-title">Actualizar Usuario</h3>
              </div>
              <div class="card-body">
                <form action="{{route('usuario.update', $usuario->id)}}" method="POST">
                  @csrf
                  @method('PUT')
              	  <div class="row">
                    <div class="col col-12 col-lg-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control form-control-sm" value="{{$usuario->name}}">
                        <input type="text" name="id" hidden="" value="{{$usuario->id}}">
                      </div>
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Correo electronico</label>
                        <input name="email" type="email" class="form-control form-control-sm" value="{{$usuario->email}}">
                      </div>                      
                    </div>        
                  </div>
                  <hr>
                  <h5>Selecciones permisos para el usuario.</h5>
                  <hr>
                  <div class="row">
                    @foreach($roles as $role)
                    <div class="col col-12 col-lg-4">
                      <div class="form-group">
                        <label>
                          <input class="@if($role->special == 'all-access') access @elseif($role->special == 'no-access') noaccess @else free @endif" type="checkbox" name="roles[]" value="{{$role->id}}"  @if($usuario->roles->contains($role->id)) checked=checked @endif >&nbsp; {{$role->name}}
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
                            <input class="free" type="checkbox" name="permissions[]" value="{{$permiso->id}}"@if($usuario->permissions->contains($permiso->id)) checked=checked @endif >&nbsp; {{$permiso->name}}
                          </label>                
                        </div>                      
                      </div>                    
                    @endforeach                            
                    </div>
                  <div class="row">
                    <div class="col-12 text-right">
                      <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-spinner"></i> Actualinzar Usuario</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>            
          </div>          
        </div>                 
        
    </section>
  </div>


@endsection

@section('js')

  @if ($errors->any())    
    @foreach ($errors->all() as $error)
        <script type="text/javascript">
          var msj = '<?php echo $error;  ?>'     
          toastr.warning(msj);
          </script>
    @endforeach}
  @endif

  <script type="text/javascript" src="{{asset('backend/js/ajax-usuario.js')}}"></script>
@endsection