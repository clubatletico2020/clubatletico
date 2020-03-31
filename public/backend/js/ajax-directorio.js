function CargarDirectorio(){
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/directorio/create",
        method: 'get',
        success: function(result){
        	$('.body-directorio').empty();
        	$.each(result, function(i,v){
          	$('.body-directorio').append('<tr><td>'+v.nombre+'</td><td>'+v.estado.estado+'</td><td align="center"><button class="btn btn-outline-primary btn-xs btn-view" onclick="View(this.id)" id="'+v.id+'" style="margin: 2px;"><i class="fa fa-eye"></i></button><button style="margin: 2px;" class="btn btn-outline-warning btn-xs btn-view-edit" onclick="Edit(this.id)" id="'+v.id+'"><i class="fa fa-edit"></i></button><button style="margin: 2px;" class="btn btn-outline-danger btn-xs btn-confirm-delete" onclick="Delete(this.id)" id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');         	
          });
        }  	
    });
}
 
jQuery('#formDirectorio').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/directorio",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarDirectorio();
            toastr.success(result);
            $("#formDirectorio")[0].reset();        
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}); 

jQuery('#formEdit').on("submit", function(e){
    event.preventDefault();
    var id = $('.btn-edit-modal').val();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/directorio/"+id,
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarDirectorio();
            toastr.success(result);
            $("#formEdit")[0].reset();
            $('#modalEdit').modal('hide');        
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}); 

function View(id){
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/directorio/"+id,
        method: 'get',
        success: function(result){
        	$('.img').attr("src", "storage/"+result.url+"");
        	$('.cargo').html('<b style="font-size:14px;">'+result.cargo+'</b>');
        	$('.name').html('<h6 class="mt-10">'+result.nombre+'</h6>');
            $('.establecimiento').html('<b style="font-style: italic;">'+result.establecimiento+'</b>');
        	$('.estado').html('<p>Estado: <small>'+result.estado.estado+'</small></p>');
            $('#modalView').modal('show');
        }     	
    });
}

function Edit(id){
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/directorio/"+id+"/edit",
        method: 'get',
        success: function(result){
            $('.btn-edit-modal').attr("value", id);
        	$('.nombre').val(result.directivo.nombre);
        	$('.cargo').val(result.directivo.cargo);
            $('.establecimiento').val(result.directivo.establecimiento);
            $('.select-estado').empty();
        	$.each(result.estados, function(i,v){
        		if (result.directivo.estado.id == v.id ) {
        			$('.select-estado').append('<option selected value="'+v.id+'">'+v.estado+'</option>');
        		}else{
        			$('.select-estado').append('<option value="'+v.id+'">'+v.estado+'</option>');
        		}          	         	
          	});
        	$('#modalEdit').modal('show');
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
        url: "/directorio/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
        	$('#modalDelete').modal('hide');
        	CargarDirectorio();
            toastr.error(result);        
        }
    });
});