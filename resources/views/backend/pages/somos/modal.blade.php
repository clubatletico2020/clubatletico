<!--MODAL NEW-->
<div class="modal fade" id="modalNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5>Nuevo Objetivo</h5>      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formItem">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Descripción</label>
                <input class="form-control" type="text" name="item" required="" maxlength="300">
              </div>            
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-outline-success btn-sm btn-new-item"><i class="fa fa-plus"></i> Añadir</button>
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
            <h6><em>¿Esta seguro de eliminar este item?</em></h6>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-danger btn-delete">Confirmar Eliminar</button>
      </div>
    </div>
  </div>
</div>