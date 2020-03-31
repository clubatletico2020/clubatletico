
<!--MODAL EDITE-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5>Editar Usuario</h5>      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formEdit">
        @csrf
        @method('PUT')
      <div class="modal-body">
        <div class="row">          
          <div class="col-12">
            <div class="form-group">
              <label>Nombre</label>
              <input class="form-control form-control-sm name" type="text" name="name">
              <input class="id" type="text" name="id" hidden="">
            </div>            
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Correo electronico</label>
              <input class="form-control form-control-sm email" type="email" name="email">
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

<!--MODAL PASSWORD-->
<div class="modal fade" id="modalPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5>Cambiar Contraseña - <small class="user"></small></h5>      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formPassword">
        @csrf
        @method('PUT')
      <div class="modal-body">
        <div class="row">          
          <div class="col-12">
            <div class="form-group">
              <label>Contraseña</label>
              <input class="form-control form-control-sm pass_1" type="password" name="password">
            </div>            
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Repetir Contraseña</label>
              <input class="form-control form-control-sm repetir_1" type="password" name="password_confirm">
            </div>            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success btn-sm btn-password-modal update-user" value="" disabled=""><i class="fas fa-spinner"></i> Actualizar</button>
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
            <h6><em>¿Esta seguro de eliminar esta alianza?</em></h6>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-danger btn-delete">Confirmar Eliminar</button>
      </div>
    </div>
  </div>
</div>