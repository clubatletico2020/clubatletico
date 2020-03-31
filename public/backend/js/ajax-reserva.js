function CargaReservas(id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/reservacapacitacion/"+id+"/edit",
        method: 'get',
        success: function(result){            
           $('.body-reserva').empty();
            $.each(result, function(i,v){
            if (v.afiliacion_id == null) {
                $('.body-reserva').append('<tr><td><b>'+v.rut+'</b></td><td>'+v.nombre_completo+'</td><td>'+v.email+'</td><td>+56 9 '+v.celular+'</td><td align="center"><span class="badge badge-success">SI</span></td><td align="center"><button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id) " id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');
            }else{
                $('.body-reserva').append('<tr><td><b>'+v.rut+'</b></td><td>'+v.nombre_completo+'</td><td>'+v.email+'</td><td>+56 9 '+v.celular+'</td><td align="center"><span class="badge badge-danger">NO</span></td><td align="center"><button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id) " id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');      
            }                       
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
        url: "/reservacapacitacion/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
        	$('#modalDelete').modal('hide');
        	CargaReservas(result.id);
            toastr.error(result.mensaje);        
        }
    });
});