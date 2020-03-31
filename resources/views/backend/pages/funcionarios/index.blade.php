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
            <h5 class="m-0 text-dark">Gestión Funcionarios</h5>
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
                        <h3 class="card-title">Nuevo Funcionario</h3>
                    </div>
                    <div class="card-body">
                        <form id="formFuncionario" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col col-12 col-lg-4">

                                <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" class="form-control form-control-sm" required="" maxlength="35">
                                </div>
                                </div>
                                <div class="col col-12 col-lg-3">
                                    <div class="form-group">
                                        <label>Imagen</label>
                                        <input name="imagen" type="file" class="form-control form-control-sm" placeholder="Seleccionar Imagen" required="">
                                    </div>
                                </div>
                                <div class="col col-12 col-lg-2">
                                    <div class="form-group">
                                        <label>Cargo</label>
                                        <input name="cargo" id="cargo_funcionario" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col col-12 col-lg-3">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select name="tipo_funcionario" class="form-control form-control-sm" required="">
                                            <option value="">Seleccionar opcion</option>
                                            @foreach($tipos_funcionarios as $tipo_funcionario)
                                                <option value="{{$tipo_funcionario->id}}">{{$tipo_funcionario->nombre}}</option>
                                            @endforeach
                                        </select>
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
                      <th>Imagen</th>
                      <th>Cargo</th>
                      <th>Tipo</th>
                      <th style="width: 120px">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="body-funcionario">
                  @foreach($funcionarios as $funcionario)
                    <tr>
                        <td>
                            {{$funcionario->nombre}}
                        </td>
                        <td style="width:100px; height:100px;">
                            {{-- img con class="w-50 rounded" --}}
                            <img  src="{{asset('storage/'.$funcionario->url)}}" align="img" style="width:100%;height:100%;max-height:100%; max-width:100%; border-radius:50%;">
                        </td>
                        <td>
                            {{$funcionario->cargo}}
                        </td>
                        <td>
                            {{$funcionario->tipo_funcionario->nombre}}
                        </td>
                        <td align="center">
                            <button class="btn btn-outline-primary btn-xs" onclick="View(this.id)" id="{{$funcionario->id}}"><i class="fa fa-eye"></i></button>
                            <button class="btn btn-outline-warning btn-xs" onclick="Edit(this.id)" id="{{$funcionario->id}}" ><i class="fa fa-edit"></i></button>
                            <button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id)" id="{{$funcionario->id}}"><i class="fa fa-trash"></i></button>
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

@include('backend/pages/funcionarios/modal')

@endsection

@section('js')

    <script>
        function storage_imagenes_eventos()
        {
            var url_imagen = "<?php echo asset('storage/');?>";
            return url_imagen;
        }
    </script>
	<script type="text/javascript" src="{{asset('backend/js/ajax-funcionario.js')}}"></script>
@endsection
