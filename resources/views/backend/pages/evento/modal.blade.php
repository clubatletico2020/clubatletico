<!--MODAL VIEW-->
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Detalle Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col col-sm-12 col-md-12 col-lg-6">
                        <img class="form-control img" src="" style="height:300px; width: 350px;">
                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-6">
                        <div class="text-center">
                            <p><b>Información</b></p>
                        </div>
                        <div class="form-group table-responsive">
                            <table class="tg" style="width:100%;">
                                <tr>
                                    <td class="tg-0lax text-right"><b>Descripcion</b></td>
                                    <td class="tg-0lax">:</td>
                                    <td class="tg-0lax descripcion"></td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax text-right"><b>Pago</b></td>
                                    <td class="tg-0lax">:</td>
                                    <td class="tg-0lax link_pago"></td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax text-right"><b>Hora</b></td>
                                    <td class="tg-0lax">:</td>
                                    <td class="tg-0lax hora_realizacion"></td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax text-right"><b>Fecha</b></td>
                                    <td class="tg-0lax">:</td>
                                    <td class="tg-0lax fecha_realizacion"></td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax text-right"><b>Lugar</b></td>
                                    <td class="tg-0lax">:</td>
                                    <td class="tg-0lax lugar_realizacion"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col text-center" style="border:1px solid #E9ECEF;">
                    <p><small>Información del Evento</small></p>
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
        <h5>Editar Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formEdit" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label>Titulo</label>
              <input class="form-control form-control-sm titulo" type="text" name="titulo" required="" maxlength="29">
              <input class="id" type="text" name="id" hidden="">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label>Autor</label>
              <input class="form-control form-control-sm autor" type="text" disabled>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Imagen</label>
              <input class="form-control form-control-sm imagen" type="file" name="imagen" >
            </div>
          </div>
          <div class="col-12">
            <div class="form-group text">

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
            <h6><em>¿Esta seguro de eliminar este empleo?</em></h6>
            <input type="hidden" name="evento_id" id="evento_id">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger btn-delete">Confirmar Eliminar</button>
      </div>
    </div>
  </div>
</div>
