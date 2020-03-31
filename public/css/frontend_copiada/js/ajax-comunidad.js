$(document).ready(function() {
  CargarComentarios($('.id_comentario').val());  	
});

function CargarComentarios(id){
	event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/cargacomentarioscomunidad/"+id,
        method: 'GET',        
        success: function(result){
          $('.body-comentario').empty(); 
          $('.load').prop('disabled', false);
        	$.each(result.data, function(i,v){
            		$('.body-comentario').append('<ol class="comments-list"><li class="single_comment_area"><div class="single-comment-wrap mb-30"><div class="d-flex justify-content-between mb-30"><div class="comment-admin d-flex"><div class="thumb"><img src="../../frontend/imagen/user.png" alt=""></div><div class="text"><h6>'+v.nombre+'</h6><span>'+v.created_at+'</span></div></div></div><p>'+v.comentario+'</p></div><ol class="children" id="respuesta'+v.id+'"></ol></li></ol>');
          		$.each(v.respuesta_opinion, function(y,b){
          			$('#respuesta'+v.id+'').append('<li class="single_comment_area" style="margin-left: 40px;"><!--coment--><div class="single-comment-wrap"><div class="d-flex justify-content-between mb-30"><div class="comment-admin d-flex"><div class="thumb"><img src="../../frontend/imagen/perfil.png" alt=""></div><div class="text"><h6>'+b.user.name+'</h6><span>'+b.created_at+'</span></div></div><div class="reply"><a><small>Respuesta</small></a></div></div><p style="margin-left: 50px;">'+b.respuesta+'</p></div></li>');
          		});
          	});
          	$('.load').val(result.next_page_url);
          	if ($('.load').val().length == '') {
          		$('.load').prop('disabled', true);
          	}
          	$('.coment_full').html('<h4>Comentarios ('+result.total+')</h4>');       
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}

function Load()
{
	event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: $('.load').val(),
        method: 'GET',
        success: function(result){             
           $.each(result.data, function(i,v){
            		$('.body-comentario').append('<ol class="comments-list"><li class="single_comment_area"><div class="single-comment-wrap mb-30"><div class="d-flex justify-content-between mb-30"><div class="comment-admin d-flex"><div class="thumb"><img src="../../frontend/imagen/user.png" alt=""></div><div class="text"><h6>'+v.nombre+'</h6><span>'+v.created_at+'</span></div></div></div><p>'+v.comentario+'</p></div><ol class="children" id="respuesta'+v.id+'"></ol></li></ol>');
          		$.each(v.respuesta_opinion, function(y,b){
          			$('#respuesta'+v.id+'').append('<li class="single_comment_area" style="margin-left: 40px;"><!--coment--><div class="single-comment-wrap"><div class="d-flex justify-content-between mb-30"><div class="comment-admin d-flex"><div class="thumb"><img src="../../frontend/imagen/perfil.png" alt=""></div><div class="text"><h6>'+b.user.name+'</h6><span>'+b.created_at+'</span></div></div><div class="reply"><a><small>Respuesta</small></a></div></div><p style="margin-left: 50px;">'+b.respuesta+'</p></div></li>');
          		});
          	});
          	$('.load').val(result.next_page_url);    
          	if ($('.load').val().length == '') {
          		$('.load').prop('disabled', true);
          	}  
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}

function showModalImagen(value){
    $('.img_modal').attr('src', "../storage/"+value+"");
    $('#documento').modal('show');
}

jQuery('#formComunidad').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/addComentarioComunidad",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            $('#formComunidad')[0].reset(); 
            CargarComentarios($('.id_comentario').val());           
            toastr.success(result.mensaje);       
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});
    