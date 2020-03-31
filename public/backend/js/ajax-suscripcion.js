
function CargarSuscripcion(){
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/suscripcion/create",
        method: 'get',
        success: function(result){
            // alert('actualizando la tabla de registros de suscripcions');
        	$('.body-suscripcion').empty();
        	$.each(result, function(i,v){
          	$('.body-suscripcion').append('<tr><td>'+v.nombre+'</td><td>'+v.correo+'</td><td align="center"><button style="margin: 2px;" class="btn btn-outline-warning btn-xs btn-view-edit" onclick="Edit(this.id)" id="'+v.id+'"><i class="fa fa-edit"></i></button><button style="margin: 2px;" class="btn btn-outline-danger btn-xs btn-confirm-delete" onclick="Delete(this.id)" id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');
          });
        }
    });
}


function limpiar_campos_modal_editar() {
    $('.btn-edit-modal').attr("value","");
    $('.nombre').val("");
    $('.correo').val("");
    $('.id').val("");
}


jQuery('#formEdit').on("submit", function(e){

    event.preventDefault();
    var id = $('.btn-edit-modal').val();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/suscripcion/"+id,
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            // alert('Respuesta servidor:'+JSON.stringify(result));
            CargarSuscripcion();
            toastr.success(result);
            $('#modalEdit').modal('hide');
            $("#formEdit")[0].reset();

        },
        error: function(result){
        //   console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});

function Edit(id){

    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/suscripcion/"+id+"/edit",
        method: 'get',
        success: function(result){
            // alert('Respuesta servidor:'+JSON.stringify(result));
            $('.btn-edit-modal').attr("value", id);
            $('#modalEdit').find(".modal-body").find('.nombre').val(result.nombre);
            $('#modalEdit').find(".modal-body").find('.correo').val(result.correo);
            $('#modalEdit').find(".modal-body").find('.id').val(id);
            // hace aparecer al modal
            $('#modalEdit').modal('show');
        },
        error: function(result){
            // console.clear();
            $.each(result.responseJSON.errors, function(_v,i){
                toastr.warning(i);
            })
        }
    });
}

function Delete(id){
  $('#modalDelete').modal('show');
  $('.btn-delete').val(id);
}


jQuery('.btn-delete').click(function(e){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/suscripcion/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
          $('#modalDelete').modal('hide');
          CargarSuscripcion();
          toastr.error(result);
        }
    });
});


$(".close").click(function (e) {
    limpiar_campos_modal_editar();
});


$("#modalEdit").on('hidden.bs.modal', function(event){
    limpiar_campos_modal_editar();
});
