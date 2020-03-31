<!--MODAL VIEW-->
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Detalle Suscripción</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row text-center">
                <div class="col col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group table-responsive">
                        <table class="tg">
                            <tr>
                                <td class="tg-0lax text-right"><b>Nombre</b></td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax nombre_suscripcion"></td>
                            </tr>
                            <tr>
                                <td class="tg-0lax text-right"><b>Email</b></td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax correo_suscripcion"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer text-right">
            <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal" aria-label="Close">
            Cerrar
            </button>
        </div>
      </div>
    </div>
  </div>

  <!--MODAL EDITE-->
  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Editar Suscripcion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formEdit" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- inicio del formulario --}}
            <div class="modal-body">
                <input class="id" type="hidden" id="id" name="id">
                <div class="row">
                    <div class="col col-sm-12 col-m-12 col-lg-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control form-control-sm nombre" required="" maxlength="35">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-sm-12 col-m-12 col-lg-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input name="correo" id="correo" type="text" class="form-control form-control-sm correo">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success btn-sm btn-edit-modal" value=""><i class="fas fa-spinner"></i> Actualizar</button>
                </div>
            </div>
            {{-- fin del formulario --}}
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
