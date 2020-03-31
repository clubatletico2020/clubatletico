<!--MODAL VIEW-->
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5>Detalle Directivo</h5>      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row text-center">
          <div class="col-6">
            <div class="col-12" align="center">
            <img class="form-control img" src="" style="height: 200px; width: 180px;">         
            </div>
          </div>
          <div class="col-6 m-auto">
            <div class="row">
              <div class="col-12 establecimiento">           
              </div>
              <div class="col-12 cargo">           
              </div>
              <div class="col-12 name">           
              </div>
              <div class="col-12 estado">           
              </div>
            </div>            
          </div>           
        </div>
      </div>
      <div class="modal-footer m-auto">
        <p><small>Información del directorio</small></p>
      </div>
    </div>
  </div>
</div>

<!--MODAL EDITE-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5>Editar Directivo</h5>      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formEdit" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>Nombre</label>
              <input class="form-control form-control-sm nombre" type="text" name="nombre" required="" maxlength="33">
            </div>            
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Cargo</label>
              <input class="form-control form-control-sm cargo" type="text" name="cargo" required="" maxlength="40">
            </div>            
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Establecimiento</label>
              <input class="form-control form-control-sm establecimiento" type="text" name="establecimiento" required="" maxlength="35">
            </div>            
          </div>
          <div class="col-6">
            <div class="form-group">
              <label>Imagen</label>
              <input class="form-control form-control-sm imagen" type="file" name="imagen">
            </div>            
          </div>
          <div class="col-6">
            <div class="form-group">
              <label>Estado</label>
              <select class="form-control form-control-sm select-estado" name="estado" required="">      
              </select>
            </div>            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success btn-sm btn-edit-modal" value=""><i class="fa fa-snniper"></i> Actualizar</button>
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
            <h6><em>¿Esta seguro de eliminar este directivo?</em></h6>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-danger btn-delete">Confirmar Eliminar</button>
      </div>
    </div>
  </div>
</div>