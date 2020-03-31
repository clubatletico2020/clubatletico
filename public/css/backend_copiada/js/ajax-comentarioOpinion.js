function CargarComentario(id)
{
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/getcomentarioopinio/"+id,
        method: 'GET',        
        success: function(result){
        	$('.body-comentario').empty();
          $.each(result, function(i,v){
            if (v.respuesta_opinion.length > '0') {
            	$('.body-comentario').append('<tr><td>'+v.nombre+'</td><td>'+v.rut+'</td><td>'+v.comentario+'</td><td>'+v.created_at+'</td><td align="center" width="100px"><button class="btn btn-outline-info btn-xs" onclick="CargarRespuestas(this.id) " id="'+v.id+'"><i class="fa fa-comments"></i></button><button class="btn btn-outline-success btn-xs" onclick="Reply(this.id) " id="'+v.id+'"><i class="fas fa-reply"></i></button><button class="btn btn-outline-danger btn-xs" onclick="DeleteComentario(this.id) " id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');
            }else{
            	$('.body-comentario').append('<tr><td>'+v.nombre+'</td><td>'+v.rut+'</td><td>'+v.comentario+'</td><td>'+v.created_at+'</td><td align="center" width="100px"><button class="btn btn-outline-success btn-xs" onclick="Reply(this.id) " id="'+v.id+'"><i class="fas fa-reply"></i></button><button class="btn btn-outline-danger btn-xs" onclick="DeleteComentario(this.id) " id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');	
            }            

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

function CargarRespuestas(id)
{
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/respuestacomentarioopinion/"+id,
        method: 'GET',        
        success: function(result){
        	$('.body-respuesta').empty();
          $.each(result, function(i,v){

            $('.body-respuesta').append('<tr><td>'+v.user.name+'</td><td>'+v.respuesta+'</td><td>'+v.created_at+'</td><td align="center"><button class="btn btn-outline-warning btn-xs" onclick="EditRespuesta(this.id) " id="'+v.id+'"><i class="fas fa-edit"></i></button><button class="btn btn-outline-danger btn-xs" onclick="DeleteRespuesta(this.id) " id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');
          	
          });  

          $('#modalRespuesta').modal('show');       
          
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}

function Reply(id)
{	$('input[name="respuesta"]').val('');
	$('.id_reply').val(id);
	$('#modalReply').modal('show');
}

jQuery('#formReply').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/respuestacomentarioopinion",
        method: 'POST',
        data:new FormData(this), 
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarComentario(result.id.id);
            toastr.success(result.mensaje);
           	$('#modalReply').modal('hide');
           	$('#formReply')[0].reset();
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});

function EditRespuesta(id)
{	
	event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/respuestacomentarioopinion/"+id+"/edit",
        method: 'GET',
        success: function(result){
            $('.respuesta_edit').html('<div class="form-group"><label>Respuesta</label><textarea class="form-control" name="respuesta_edit" required="">'+result.respuesta+'</textarea></div>')
            $('.btn-edit-respuesta').val(result.id);
            $('#modalEditRespuesta').modal('show');
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}

jQuery('#formRespuestaEdit').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/respuestacomentarioopinion/"+$('.btn-edit-respuesta').val(),
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarComentario($('.id_opinion_s').val());
            toastr.success(result);
            $('#modalRespuesta').modal('hide');
           	$('#modalEditRespuesta').modal('hide');
           	$('#formRespuestaEdit')[0].reset();
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});


function DeleteRespuesta(id)
{
	$('.btn-delete-respuesta').val(id);
	$('#modalDeleteRespuesta').modal('show');
}

$('.btn-delete-respuesta').click(function(e){
	event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/respuestacomentarioopinion/"+$('.btn-delete-respuesta').val(),
        method: 'DELETE',        
        success: function(result){
            CargarComentario($('.id_opinion_s').val());
            toastr.error(result);
            $('#modalRespuesta').modal('hide');
           	$('#modalDeleteRespuesta').modal('hide');
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});	

function DeleteComentario(id)
{
	$('.btn-delete-comentario').val(id);
	$('#modalDeleteComentario').modal('show');
}

$('.btn-delete-comentario').click(function(e){
	event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/comentarioopinion/"+$('.btn-delete-comentario').val(),
        method: 'DELETE',        
        success: function(result){
            CargarComentario($('.id_opinion_s').val());
            toastr.error(result.mensaje);
           	$('#modalDeleteComentario').modal('hide');
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});