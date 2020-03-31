$(document).ready(function() {


	jQuery('#formEvento').on("submit", function(e){
        event.preventDefault();
        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        jQuery.ajax({
            url: "evento",
            method: 'POST',
            data:new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(result){
                // CargarCapacitacion();
                toastr.success(result);
                CargarEventos();
                // $("#formEvento")[0].reset();
                // $('.textarea_edit').empty();
                // $('.textarea_edit').html('<textarea id="textarea" name="temario" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>');
                // $('.textarea').summernote();
                // alert("Respuesta servidor:"+JSON.stringify(result));
            },
            error: function(result){
              // console.clear();
              $.each(result.responseJSON.errors, function(v,i){
                toastr.warning(i);
              })
            }
        });
    });
});

function Edit(id){

    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/evento/"+id+"/edit",
        method: 'get',
        success: function(result){
            // $('.btn-edit-modal').attr("value", id);
            // $('.img-show').attr('src', 'storage/'+result.url_imagen+'');
            // $('.url').val(result.url_destino);
            alert("Respuesta servidor:"+JSON.stringify(result));
            $('#modalEdit').modal('show');
        }
    });
}

function View(id){

  var storage_imagenes_ = storage_imagenes_eventos();

  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/evento/"+id,
        method: 'get',
        success: function(result){
          // alert("Respuesta servidor:"+JSON.stringify(result["evento"]));
          // alert("Respuesta servidor:"+JSON.stringify(result));
          // alert(storage_imagenes_+"/"+result.url);
          $('#modalView').modal('show');
          $('#modalView').find(".modal-body").find('.img').attr("src", storage_imagenes_+"/"+result["evento"].url);
          $('.descripcion').html(result["evento"].descripcion);
          $('.link_pago').html(result["evento"].link_pago);
          $('.hora_realizacion').html(result.hora);
          $('.fecha_realizacion').html(result.fecha_evento);
          $('.lugar_realizacion').html(result["evento"].lugar_realizacion);
        }
    });
}

function CargarEventos(){

    var storage_imagenes_ = storage_imagenes_eventos();

  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/evento/create",
        method: 'get',
        success: function(result){
          $('.body-evento').empty();
            $.each(result, function(i,v){
            $('.body-evento').append('<tr><td>'+v.titulo+'</td><td><img class="w-50 rounded" src="'+storage_imagenes_+'/'+v.url+'" align="img"></td><td>'+v.descripcion+'</td><td>'+v.link_pago+'</td><td>'+v.fecha_realizacion+'</td><td>'+v.lugar_realizacion+'</td><td align="center"><button class="btn btn-outline-info btn-xs" style="margin: 2px;" onclick="View(this.id)" id="'+v.id+'"><i class="fa fa-eye"></i></button><a href="evento/'+v.id+'/edit"><button class="btn btn-outline-warning btn-xs"style="margin: 2px;"><i class="fa fa-edit"></i></button></a><button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id)" id="'+v.id+'" style="margin: 2px;"><i class="fa fa-trash"></i></button></td></tr>');
          });
        }
    });
}


function Delete(id){
  $('#modalDelete').modal('show');
  $('.btn-delete').val(id);
}

// $('#modalDelete').modal('show');

jQuery('.btn-delete').click(function(e){

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
//
    jQuery.ajax({
        url: "/evento/"+$(".btn-delete").val(),
        method: 'delete',
        dataType: 'JSON',
        success: function(result){

          $('#modalDelete').modal('hide');
          CargarEventos();
          toastr.error(result);
        },
            error: function(result){
              // console.clear();
              $.each(result.responseJSON.errors, function(v,i){
                toastr.warning(i);
              })
            }
    });
});
