@extends('layouts/backend')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{asset('backend/css/modulos/eventos/tabla_modal_ver.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Gestión Eventos</h5>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Nuevo evento</h3>
                        </div>
                        <div class="card-body">
                            <form id="formEvento" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col col-sm-12 col-md-4 col-lg-4">
                                    <!-- text input -->
                                        <div class="form-group">
                                            <label>Titulo</label>
                                            <input type="text" name="titulo" class="form-control form-control-sm" required="" maxlength="29">
                                        </div>
                                    </div>
                                    <div class="col col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Imagen</label>
                                            <input name="imagen" type="file" class="form-control form-control-sm" placeholder="Seleccionar Imagen" required="">
                                        </div>
                                    </div>
                                    <div class="col col-sm-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <div class="input-group date" data-provide="fecha_realizacion">
                                                <input id="fecha_realizacion" class="form-control form-control-sm" name="fecha_realizacion">
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
                                                <input type="text" name="hora" id="hora" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <div class="mb-3 textarea_edit">
                                                <textarea name="descripcion" class="textarea" placeholder="Place some text here"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Url medio de pago</label>
                                            <div class="mb-3 textarea_edit">
                                                <input type="text"  name="link_pago" class="form-control form-control-sm">
                                            </div>
                                            <a href="http://www.flow.cl" target="_blank">Link de pago.</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Lugar realización</label>
                                            <div class="mb-3 textarea_edit">
                                                <textarea  name="lugar_realizacion" class="form-control" required="" rows="1" style="resize:none;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <select class="form-control form-control-sm" name="estado">
                                                @foreach($estados as $estado)
                                                <option value="{{$estado->id}}">{{$estado->estado}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i> Subir Aviso</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Listado</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Imagen</th>
                                        <th>Descripción</th>
                                        <th>Url de Pago</th>
                                        <th>Fecha</th>
                                        <th>Lugar</th>
                                        <th style="width: 120px">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="body-evento">
                                    @forelse($eventos as $evento)
                                    <tr>
                                        <td>
                                            {{$evento->titulo}}
                                        </td>
                                        <td>
                                            <img class="w-50 rounded" src="{{asset('storage/'.$evento->url)}}" align="img">
                                        </td>
                                        <td>
                                            {{$evento->descripcion}}
                                        </td>
                                        <td>
                                            {{$evento->link_pago}}
                                        </td>
                                        <td>
                                            {{$evento->fecha_realizacion}}
                                        </td>
                                        <td>
                                            {{$evento->lugar_realizacion}}
                                        </td>
                                        <td align="center">
                                            <button class="btn btn-outline-primary btn-xs" onclick="View(this.id)" id="{{$evento->id}}"><i class="fa fa-eye"></i></button>
                                            <a href="{{route('evento.edit',$evento->id)}}">
                                                <button class="btn btn-outline-warning btn-xs"style="margin: 2px;"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id) " id="{{$evento->id}}"><i class="fa fa-trash"></i></button>
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

@include('backend/pages/evento/modal')


@endsection

@section('js')
<script type="text/javascript">
    function storage_imagenes_eventos()
    {
    var url_imagen = "<?php echo asset('storage/');?>";
    return url_imagen;
    }

</script>
  <script type="text/javascript" src="{{asset('backend/js/ajax-evento.js')}}"></script>
  <script type="text/javascript" src="{{asset('backend/plugins/jquery.inputmask/dist/jquery.inputmask.bundle.js')}}"></script>
    <script>
        $('#fecha_realizacion').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
        });

        $("#hora").val("");
        $('#hora').inputmask("hh:mm:ss", {
          placeholder: "HH:MM:SS",
          insertMode: false,
          showMaskOnHover: false,
          hourFormat: "24"
        });
    </script>
@endsection
