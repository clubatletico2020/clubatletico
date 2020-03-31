@extends('layouts/backend')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">Edición Capacitación</h5>
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
                <h3 class="card-title">Formulario de edición</h3>
              </div>
              <div class="card-body">
                <form action="{{route('capacitacionadmin.update', $capacitacion->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
              	  <div class="row">
                    <div class="col col-12 col-lg-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" name="titulo" class="form-control form-control-sm" required="" maxlength="29" value="{{$capacitacion->titulo}}">
                      </div>
                    </div>
                    <div class="col col-12 col-lg-2">
                      <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control form-control-sm" name="estado" required="">
                          @foreach($estados as $estado)
                            @if($capacitacion->estado_id == $estado->id)
                              <option value="{{$estado->id}}" selected="">{{$estado->estado}}</option>
                            @else
                              <option value="{{$estado->id}}">{{$estado->estado}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div> 
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Imagen</label>
                        <div class="input-group input-group-sm mb-3">
                          <input name="imagen" type="file" class="form-control form-control-sm" placeholder="Seleccionar Imagen" >
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#modalImg"><i class="fa fa-eye"></i></button>
                          </div>
                        </div>                        
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Autor</label>
                        <input type="text" class="form-control form-control-sm" value="{{$capacitacion->user->name}}" disabled="">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Fecha Emision</label>
                        <div class="input-group date" data-provide="datepicker">
                          @if($capacitacion->fecha_emision == null)
                            <input id="datepicker" class="form-control form-control-sm" name="fecha_emision" >
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                          @else
                            <input id="datepicker" class="form-control form-control-sm" name="fecha_emision" value="{{date('d-m-Y', strtotime($capacitacion->fecha_emision))}}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                          @endif
                        </div>
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Precio Socio - <small>(Opcional)</small></label>
                        <input type="text" class="form-control form-control-sm" name="precio_socio" onkeyup="format(this)" value="{{$capacitacion->precio_socio}}">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Precio No Socio - <small>(Opcional)</small></label>
                        <input type="text" class="form-control form-control-sm" name="precio_no_socio" onkeyup="format(this)" value="{{$capacitacion->precio_no_socio}}">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Precio Estudiante - <small>(Opcional)</small></label>
                        <input type="text" class="form-control form-control-sm" name="precio_estudiante" onkeyup="format(this)" value="{{$capacitacion->precio_estudiante}}">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-2">
                      <div class="form-group">
                        <label>Horas Pedagogicas</label>
                        <input type="number" class="form-control form-control-sm" name="horas" value="{{$capacitacion->horas}}"  maxlength="7">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Cupos - <small>Campo vacio significa ilimitado.</small></label>
                        <input type="number" class="form-control form-control-sm" name="cupos" value="{{$capacitacion->cupos}}" maxlength="4">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-7">
                      <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control form-control-sm" name="direccion" value="{{$capacitacion->direccion}}" required="" maxlength="120">
                      </div>                      
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label>Temario</label>
                        <div class="mb-3 textarea_edit">
                          <textarea name="temario" class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$capacitacion->temario}}</textarea>
                      </div>
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
        
    </section>
  </div>

<!--MODAL IMAGEN-->
<div class="modal fade" id="modalImg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">         
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <img width="100%" src="{{asset('storage/'.$capacitacion->url)}}">
          </div>
        </div>
      </div>
      <div class="modal-footer">        
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')

@if ($errors->any())      
    @foreach ($errors->all() as $error)      
      <script type="text/javascript">
      var error = '<?php echo $error;?>';
      toastr.warning(error);
    </script>
    @endforeach
  @endif
  
<script>
  $('#datepicker').datepicker({
      uiLibrary: 'bootstrap4',
      format: 'dd-mm-yyyy',
  });
</script>

<script type="text/javascript" src="{{asset('backend/js/ajax-capacitacion.js')}}"></script>
@endsection