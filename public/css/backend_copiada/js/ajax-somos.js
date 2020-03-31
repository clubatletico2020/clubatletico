function CargarImagen(){
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/somos/create",
        method: 'get',
        success: function(result){
          if (result.url.length != 0) {
            $(".body-img").html('<img class="w-50 rounded" src="storage/'+result.url+'" align="img">');
            $('.body-button-delete').append('<button type="button" class="btn btn-outline-danger btn-sm btn-delete-imagen" onclick="DeleteImagen()"><i class="fa fa-trash"></i> Eliminar Imagen</button>');
          }          
        }   
    });
}

function CargarDocumento(){
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/somos/createDocumento",
        method: 'get',
        success: function(result){
          if (result.length == 0) {
              $(".body-doc").html('<p><small>Sin información cargada.</small></p>');
          }else{
            if (result.tipo_archivo_id == 1) {
              $(".body-doc").html('<p><small>Tienes cargado un documento. </small></p>');
            }else if(result.tipo_archivo_id == 2){
              $('.body-doc').html('<p><small>Tienes cargada una imagen. </small></p>');
            }
          }          
        }   
    });
}

jQuery('#formSomos').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/somos",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarImagen();          
            toastr.success(result);
            $(".imagen_somos").val('');        
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}); 

jQuery('#formDirectorio').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/somosDocumento/1",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){          
            toastr.success(result);
            CargarDocumento();
            $(".tipo").empty();
            $('.tipo_archivo').val('');


        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}); 

$('.tipo_archivo').change(function(e){	
    var tipo = $('.tipo_archivo').val();
    if (tipo == 1) {
      $('.tipo').html('<label>Buscar Documento</label><input type="file" name="documento" class="form-control form-control-sm" required >');
    }else if(tipo == 2){
      $('.tipo').html('<label>Buscar Imagen</label><input type="file" name="imagen" class="form-control form-control-sm" required>');
    }else{
      $('.tipo').empty();
    }
});

function DeleteImagen()
{
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/somos/1",
        method: 'delete',
        success: function(result){
         $('.body-img').empty();
         $('.btn-delete-imagen').hide();
         toastr.error(result);
        }       
    });
}
