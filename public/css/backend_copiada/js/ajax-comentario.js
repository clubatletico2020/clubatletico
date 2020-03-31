function CargarComentario(){
	var id = $('.id').val();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/comentarioadmin/"+id+"/edit",
        method: 'get',
        success: function(result){
            $('.body-comentario').empty();
            $.each(result, function(i,v){
            $('.body-comentario').append('<tr><td>'+v.nombre+'</td><td>'+v.comentario+'</td><td>'+v.created_at+'</td><td align="center"><button style="margin: 2px;" class="btn btn-outline-danger btn-xs btn-confirm-delete" onclick="Delete(this.id)" id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');           
          });
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
        url: "/comentarioadmin/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
        	$('#modalDelete').modal('hide');
        	CargarComentario();
            toastr.error(result);        
        }
    });
});