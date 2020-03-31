@extends('layouts/backend')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">Gestión Evento</h5>
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
                <h3 class="card-title">Actualizar Evento</h3>
              </div>
              <div class="card-body">
                <form  action="{{route('evento.update', $evento->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="id_evento" value="{{$evento->id}}">
                  <div class="row">
                    <div class="col col-sm-12 col-md-4 col-lg-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" value="{{$evento->titulo}}" name="titulo" class="form-control form-control-sm" required="" maxlength="29">
                      </div>
                    </div>
                    <div class="col col-sm-12 col-md-4 col-lg-4">
                      <div class="form-group">
                        <label>Imagen</label>
                        <input name="imagen" type="file" class="form-control form-control-sm" placeholder="Seleccionar Imagen">
                      </div>                      
                    </div>
                    <div class="col col-sm-12 col-md-2 col-lg-2">
                      <div class="form-group">
                        <label>Fecha</label>
                        <div class="input-group date" data-provide="fecha_realizacion">
                            <?php 
                              $hora = explode(" ",$evento->fecha_realizacion);
                              $date=date_create($hora[0]);
                              $fecha_evento = date_format($date,'d-m-Y');
                             ?>
                            <input id="fecha_realizacion" class="form-control form-control-sm" value="{{$fecha_evento}}" name="fecha_realizacion">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                      </div>    
                    </div>
                    <div class="col col-sm-12 col-md-2 col-lg-2">
                      <div class="form-group">
                        <label>Hora</label>
                        <div class="input-group">
                            
                            <input type="text"  name="hora" id="hora" class="form-control form-control-sm">
                        </div>
                      </div>                     
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Descripción</label>
                        <div class="mb-3 textarea_edit">
                          <textarea name="descripcion" class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$evento->descripcion}}</textarea>
                        </div>
                      </div>                      
                    </div>  
                  </div>
                  <div class="row">
                    <div class="col col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <label>Url medio de pago</label>
                        <div class="mb-3 textarea_edit">
                            <input type="text"  value="{{$evento->link_pago}}" name="link_pago" class="form-control form-control-sm">
                        </div>
                      </div>                      
                    </div> 
                  </div>
                  <div class="row">
                    <div class="col col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <label>Lugar realización</label>
                        <div class="mb-3 textarea_edit">
                            <textarea  name="lugar_realizacion" class="form-control" required="" rows="1" >{{$evento->lugar_realizacion}}</textarea>
                        </div>
                      </div>                      
                    </div> 
                  </div>
                  <div class="row">
                    <div class="col col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                          <select class="form-control form-control-sm" name="estado">
                            @foreach($estados as $estado)
                              <option value="{{$estado->id}}" @if($estado->id==$evento->estado_id) selected @endif>{{$estado->estado}}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-right">
                      <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i> Actualizar Evento</button>
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
  <script type="text/javascript" src="{{asset('backend/js/ajax-evento.js')}}"></script>
  <script type="text/javascript" src="{{asset('backend/plugins/jquery.inputmask/dist/jquery.inputmask.bundle.js')}}"></script>
    <script>
        $('#fecha_realizacion').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
        });

        $("#hora").val('<?php echo $hora[1]; ?>');
        $('#hora').inputmask("hh:mm:ss", {
          placeholder: "HH:MM:SS", 
          insertMode: false, 
          showMaskOnHover: false,
          hourFormat: "24"
        });

    </script>
@endsection