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
            <h5 class="m-0 text-dark">Gestión Noticias</h5>
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
                <h3 class="card-title">Nueva Noticia</h3>
              </div>
              <div class="card-body">
                <form id="formNoticia" enctype="multipart/form-data">
                  @csrf
              	  <div class="row">
                    <div class="col col-12 col-lg-4">

                      <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" name="titulo" class="form-control form-control-sm" required="" maxlength="35">
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
                    <div class="col-12">
                      <div class="form-group">
                        <label>Descripción</label>
                        <div class="mb-3 textarea_edit">
                          <textarea id="textarea_uno" name="descripcion" class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      </div>
                      </div>
                    </div>
                    <div class="col col-sm-12 col-md-2 col-lg-2">
                        <div class="form-group">
                          <label>Fecha</label>
                          <div class="input-group date" data-provide="fecha_noticia">
                              <input id="fecha_noticia" class="form-control form-control-sm" name="fecha_noticia">
                              <div class="input-group-addon">
                                  <span class="glyphicon glyphicon-th"></span>
                              </div>
                          </div>
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
                      <th>Titulo</th>
                      <th>Autor</th>
                      <th>Estado</th>
                      <th style="width: 120px">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="body-noticia">
                  @foreach($noticias as $noticia)
                    <tr>
                      <td>{{$noticia->titulo}}</td>
                      <td>
                          {{$noticia->user->name}}
                      </td>
                      <td>
                        {{$noticia->estado->estado}}

                      </td>
                      <td align="center">
                        <button class="btn btn-outline-primary btn-xs" onclick="View(this.id)" id="{{$noticia->id}}"><i class="fa fa-eye"></i></button>
                        <button class="btn btn-outline-warning btn-xs" onclick="Edit(this.id)" id="{{$noticia->id}}" ><i class="fa fa-edit"></i></button>
                        <button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id)" id="{{$noticia->id}}"><i class="fa fa-trash"></i></button>
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

@include('backend/pages/noticias/modal')

@endsection

@section('js')

    <script>
        function storage_imagenes_eventos()
        {
            var url_imagen = "<?php echo asset('storage/');?>";
            return url_imagen;
        }

        $('#fecha_noticia').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
        });

        $('#fecha_noticia_editar').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
        });
    </script>
	<script type="text/javascript" src="{{asset('backend/js/ajax-noticia.js')}}"></script>
@endsection
