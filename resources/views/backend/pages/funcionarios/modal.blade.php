<!--MODAL VIEW-->
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Detalle Funcionario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- nuevo diseño --}}
                <div class="row text-center">
                    <div class="col col-sm-12 col-md-12 col-lg-6 img">
                        <img class="form-control img_tipo_funcionario" src="" style="height:300px; width: 350px;">
                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-6">
                        <div class="text-center">
                            <p><b>Información</b></p>
                        </div>
                        <div class="form-group table-responsive">
                            <table class="tg table table-bordered">
                                <tr>
                                  <td class="tg-0lax text-right"><b>Nombre</b></td>
                                  <td class="tg-0lax">:</td>
                                  <td class="tg-0lax text-left nombre_funcionario"></td>
                                </tr>
                                <tr>
                                  <td class="tg-0lax text-right"><b>Cargo</b></td>
                                  <td class="tg-0lax">:</td>
                                  <td class="tg-0lax text-left cargo_funcionario"></td>
                                </tr>
                                <tr>
                                  <td class="tg-0lax text-right"><b>Tipo</b></td>
                                  <td class="tg-0lax">:</td>
                                  <td class="tg-0lax text-left tipo_funcionario"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- fin nuevo diseño --}}
                <div class="col text-center" style="border:1px solid #E9ECEF;">
                    <p><small>Información del Funcionario</small></p>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-label="Close">
                Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!--MODAL EDITE-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Editar Funcionario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form id="formEdit" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="modal-body">
        {{-- Titulos de Imagen e Informacion --}}
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="form-group">
                <label>Imagen</label>
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                  <label for="">Información</label>
                </div>
            </div>
        </div>
        {{-- Fila de la imagen y los campos del formulario --}}
        <div class="row form-group">
            {{-- fila donde va impresa la imagen de la noticia --}}
            <div class="col-sm-12 col-md-6 col-lg-6" style="border: 0px solid black;padding:0px 0px;margin:0px 0px;">
                <img class="editar_img_tipo_funcionario" src="" style="height:100%; width:100%;padding:0px 0px;">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                {{-- subfila de el titulo de la noticia --}}
                <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label>Nombre</label>
                            <input class="form-control form-control-sm editar_nombre_funcionario" type="text" name="nombre" required="" maxlength="35">
                            <input class="id" type="text" name="id" hidden="">
                      </div>
                    </div>
                </div>
                {{-- subfila del estado de la noticia --}}
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Cargo</label>
                            <input class="form-control form-control-sm editar_cargo_funcionario" name="cargo" required="" type="text">
                        </div>
                    </div>
                </div>
                {{-- subfiila del boton de la imagen --}}
                <div class="row">
                    <div class="col col-12 col-lg-12">
                        <div class="form-group">
                            <label>Tipo</label>
                            <select name="tipo_funcionario" class="form-control form-control-sm editar_tipo_funcionario" required="">
                                <option value=""></option>
                                @foreach($tipos_funcionarios as $tipo_funcionario)
                                    <option value="{{$tipo_funcionario->id}}">{{$tipo_funcionario->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Controles de la Imagen</label>
                            <input class="form-control form-control-sm imagen" type="file" name="imagen" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success btn-sm btn-edit-modal" value=""><i class="fas fa-spinner"></i> Actualizar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--MODAL DELETE-->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Confirmar Eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <h6><em>¿Esta seguro de eliminar esta noticia?</em></h6>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-danger btn-delete">Confirmar Eliminar</button>
      </div>
    </div>
  </div>
</div>
