$(document).ready(function(){
    $('#modalEdit').on('shown.bs.modal', function(){
        // alert('#modalEdit');
        // este plugin manda error cuando se utiliza en el navegador
        // $('#textarea').wysihtml5();
    });
});


function CargarConvenio(){
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/noticia/create",
        method: 'get',
        success: function(result){
            // alert('actualizando la tabla de registros de noticias');
        	$('.body-noticia').empty();
        	$.each(result, function(i,v){
          	$('.body-noticia').append('<tr><td>'+v.titulo+'</td><td>'+v.user.name+'</td><td>'+v.estado.estado+'</td><td align="center"><button class="btn btn-outline-primary btn-xs btn-view" onclick="View(this.id)" id="'+v.id+'" style="margin: 2px;"><i class="fa fa-eye"></i></button><button style="margin: 2px;" class="btn btn-outline-warning btn-xs btn-view-edit" onclick="Edit(this.id)" id="'+v.id+'"><i class="fa fa-edit"></i></button><button style="margin: 2px;" class="btn btn-outline-danger btn-xs btn-confirm-delete" onclick="Delete(this.id)" id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');
          });
        }
    });
}

/*======================================*/
//       Comentarios
/*======================================*/
/*
Limpia todos los campos del formulario una vez que el modal cuando se cierra
*/
function limpiar_campos_modal_editar() {
    $('.btn-edit-modal').val("");
    $('.titulo').val("");
    $('.user').val("");
    $('.id').val("");
    $('.text').html('');
    $('.select-estado').empty();
    $('.fecha_noticia').val("");
    $('.select-estado').append('');
    $('#modalEdit').find(".modal-body").find('.imagen_noticia').append("");
}

/*======================================*/
//       Comentarios
/*======================================*/
/*
    Enviar el formulario de Guardar una noticia por ajax.
*/

jQuery('#formNoticia').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/noticia",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarConvenio();
            toastr.success(result);
            // alert('Respuesta servidor:'+JSON.stringify(result));
            // $("#formNoticia")[0].reset();
            // $('.textarea_edit').empty();
            // $('.textarea_edit').html('<textarea id="textarea" name="descripcion" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>');
            // $('.textarea').summernote();
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});


/*======================================*/
//       Comentarios
/*======================================*/
/*
    Formulario tipo Modal que edita los campos
    de una fila de la tabla y los envia al servidor
    para aactualizarlos.
*/
jQuery('#formEdit').on("submit", function(e){

    event.preventDefault();
    var id = $('.btn-edit-modal').val();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/noticia/"+id,
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            //alert('Respuesta servidor:'+JSON.stringify(result));
            CargarConvenio();
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

function View(id){

    var storage_imagenes_ = storage_imagenes_eventos();

    //alert('id:'+id);
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/noticia/"+id,
        method: 'get',
        success: function(result){
            // alert(storage_imagenes_);
            // alert(result.noticia.url);
        // alert('Respuesta servidor:'+JSON.stringify(result));
        $('#modalView').find(".modal-body").find('.img').html('<img class="form-control" src="'+storage_imagenes_+"/"+result.noticia.url+'" style="height: 250px; width: 350px;">');
        // $('#modalView').find(".modal-body").find('.img').attr("src", storage_imagenes_+"/"+result["evento"].url);
        $('.ver_noticia_titulo').html(result.noticia.titulo);
        $('.ver_noticia_estado').html(result.noticia.estado.estado);
        $('.ver_noticia_fecha').html(result.noticia.fecha_noticia);
        $('.ver_noticia_descripcion').html(result.noticia.descripcion);
        $('.ver_noticia_usuario').html(result.noticia.user.name);
        $('#modalView').modal('show');
        }
    });
}

function Edit(id){

    limpiar_campos_modal_editar();
    var storage_imagenes_ = storage_imagenes_eventos();


    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/noticia/"+id+"/edit",
        method: 'get',
        success: function(result){

            $('.btn-edit-modal').attr("value", id);
            $('.titulo').val(result.noticia.titulo);
            $('.user').val(result.noticia.user.name);
            $('.id').val(id);
            $('.text').html('<label>Descripción</label><textarea id="textarea_editar" name="descripcion" class="textarea_editar" placeholder="Place some text here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;resize:none;">'+result.noticia.descripcion+'</textarea>');
            $('.select-estado').empty();
            $('.fecha_noticia').val(result.noticia.fecha_noticia);

            $.each(result.estados, function(i,v){
                if (result.noticia.estado.id == v.id ) {
                $('.select-estado').append('<option selected value="'+v.id+'">'+v.estado+'</option>');
                }else{
                $('.select-estado').append('<option value="'+v.id+'">'+v.estado+'</option>');
                }
            });
            $('#modalEdit').find(".modal-body").find('.imagen_noticia').val("");
            $('#modalEdit').find(".modal-body").find('.imagen_noticia').attr("src", storage_imagenes_+"/"+result.noticia.url);

            // Inicia el plugin de estilos de texto en el textarea del modal editar
            $('#modalEdit').find(".modal-body").find('.textarea_editar').summernote();

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
    //alert('id:'+$(".btn-delete").val());
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/noticia/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
          $('#modalDelete').modal('hide');
          CargarConvenio();
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
