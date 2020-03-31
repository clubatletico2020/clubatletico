$( document ).ready(function() {
    CargaComentario();
});

function CargaComentario()
{
    var id = $('#id').val();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/getcomentario/"+id,
        method: 'GET',
        success: function(result){
                $('#coments').empty();
            $.each(result, function(i,v){
                $('#coments').append('<div class="single-review mb-30"><div class="d-flex justify-content-between mb-30"><div class="review-admin d-flex"><div class="thumb"><img src="../frontend/imagen/coment.png" alt=""></div><div class="text"><h6>'+v.nombre+'</h6><span>'+v.created_at+'</span></div></div></div><p>'+v.comentario+'</p></div>');
            });     
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}

jQuery('#formComentario').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/comentario",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargaComentario();
            toastr.success(result);
            $("#formComentario")[0].reset();        
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});

jQuery('#formInscripcion').on("submit", function(e){
    event.preventDefault();
    $('.btn_send_inscripcion').prop('disabled', true);
    $('#i_inscripcion').attr('class', 'spinner-border text-info spinner-border-sm');
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/sendinscripcion",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            $('#i_inscripcion').attr('class', 'fa fa-send');
            $('.btn_send_inscripcion').prop('disabled', false);
            toastr.success(result);
            $("#formInscripcion")[0].reset();
            $('#exampleModal').modal('hide');        
        },
        error: function(result){
            $('#i_inscripcion').attr('class', 'fa fa-send');
            $('.btn_send_inscripcion').prop('disabled', false);
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});