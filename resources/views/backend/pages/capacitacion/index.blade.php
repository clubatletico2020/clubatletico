  @extends('layouts/backend')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">Gestión Capacitaciones</h5>
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
                <div class="row">
                  <h3 class="card-title">Nueva capacitación</h3>                 
                </div>                
              </div>
              <div class="card-body">
                <form id="formCapacitacion" enctype="multipart/form-data">
                  @csrf
              	  <div class="row">
                    <div class="col col-12 col-lg-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" name="titulo" class="form-control form-control-sm"  required="" maxlength="29">
                      </div>
                    </div>
                    <div class="col col-12 col-lg-2">
                      <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control form-control-sm" name="estado" required="">
                          @foreach($estados as $estado)
                            <option value="{{$estado->id}}">{{$estado->estado}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div> 
                    <div class="col col-12 col-lg-2">
                      <div class="form-group">
                        <label>Imagen</label>
                        <input name="imagen" type="file" class="form-control form-control-sm" placeholder="Seleccionar Imagen" required="">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-4">
                      <div class="form-group">
                        <label>Autor</label>
                        <input type="text" class="form-control form-control-sm" value="{{Auth()->user()->name}}" disabled="">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Fecha Emision</label>
                        <div class="input-group date" data-provide="datepicker">
                            <input id="datepicker" class="form-control form-control-sm" name="fecha_emision">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Precio Socio - <small>(Opcional)</small></label>
                        <input type="text" class="form-control form-control-sm" onkeyup="format(this)" name="precio_socio">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Precio No Socio - <small>(Opcional)</small></label>
                        <input type="text" class="form-control form-control-sm" onkeyup="format(this)" name="precio_no_socio">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Precio Estudiante - <small>(Opcional)</small></label>
                        <input type="text" class="form-control form-control-sm" onkeyup="format(this)" name="precio_estudiante">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-2">
                      <div class="form-group">
                        <label>Horas Pedagogicas</label>
                        <input type="number" class="form-control form-control-sm" name="horas" maxlength="6">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-3">
                      <div class="form-group">
                        <label>Cupos - <small>Campo vacio significa ilimiatado.</small></label>
                        <input type="number" class="form-control form-control-sm" name="cupos" maxlength="4">
                      </div>                      
                    </div>
                    <div class="col col-12 col-lg-7">
                      <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control form-control-sm" name="direccion" required="" maxlength="120">
                      </div>                      
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label>Temario</label>
                        <div class="mb-3 textarea_edit">
                          <textarea name="temario" class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      </div>
                      </div>                      
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-12 text-right">
                      <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i> Subir Capaticacion</button>
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
                <div class="row">
                  <div class="col-6">
                    <h3 class="card-title">Listado</h3>
                  </div>
                  <div class="col-6 text-right">
                    <small><b>R</b>: Reservas</small>
                  </div>               
              </div>

              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>                      
                      <th>Titulo</th>
                      <th>Fecha Emisión</th>
                      <th>Estado</th>
                      <th>Autor</th>
                      <th>R</th>
                      <th style="width: 140px">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="body-capacitacion">
                    @forelse($capacitaciones as $capacitacion)
                    <tr>                     
                      <td>{{$capacitacion->titulo}}</td>
                      <td>@if($capacitacion->fecha_emision == null) no definida @else {{date('d - m - Y',strtotime($capacitacion->fecha_emision))}} @endif</td>
                      <td>{{$capacitacion->estado->estado}}</td>
                      <td>                        
                          {{$capacitacion->user->name}}                        
                      </td>
                      <td align="center">                        
                          <a href="{{route('reservacapacitacion.show', $capacitacion->id)}}"><button type="button" class="btn btn-xs btn-outline-success">{{count($capacitacion->reservcapacitacion)}}</button></a>        
                      </td>
                      <td align="center">
                        <a href="{{route('comentarioadmin.show', $capacitacion->id)}}"><button class="btn btn-outline-info btn-xs"><i class="fa fa-comments"></i></button></a>
                        <button class="btn btn-outline-primary btn-xs" onclick="View(this.id)" id="{{$capacitacion->id}}"><i class="fa fa-eye"></i></button>
                        <a href="{{route('capacitacionadmin.edit',$capacitacion->id)}}"><button class="btn btn-outline-warning btn-xs"><i class="fa fa-edit"></i></button></a>
                        <button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id) " id="{{$capacitacion->id}}"><i class="fa fa-trash"></i></button>
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

@include('backend/pages/capacitacion/modal')

@endsection

@section('js')
@if (\Session::has('success'))
    <script type="text/javascript">
      var msj = '<?php echo \Session::get('success');  ?>'     
      toastr.success(msj);
     </script>
@endif

    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
        });

    </script>
	<script type="text/javascript" src="{{asset('backend/js/ajax-capacitacion.js')}}"></script>
@endsection