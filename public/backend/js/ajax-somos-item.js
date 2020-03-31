$('.btn-new').click(function(){
	$('#modalNew').modal('show');
});

function CargarItem(){
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/itemsomos",
        method: 'get',
        success: function(result){
        	$('#body-item').empty();
        	$.each(result, function(i,v){
          	$('#body-item').append('<div class="col col-12 col-lg-10"><div class="form-group"><input type="text" class="form-control '+v.id+'" name="item" value="'+v.item+'" required="" maxlength="300"></div></div><div class="col col-6 col-lg-1 text-center"><div class="form-group"><button class="btn btn-outline-warning btn-sm btn-block" onclick="Actualizaritem(this.id)" id="'+v.id+'"><i class="fa fa-edit"></i></button></div></div><div class="col col-6 col-lg-1 text-center"><div class="form-group"><button class="btn btn-outline-danger btn-sm btn-block" onclick="Eliminarconfirmar(this.id)" id="'+v.id+'"><i class="fa fa-trash"></i></button></div></div>');
          });        	
        }      
        }
    );
}

jQuery('#formItem').on('submit',function(){
    event.preventDefault();
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/itemsomos",
        method: 'post',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            $('#modalNew').modal('hide');
            $("#formItem")[0].reset();  
        	CargarItem();
        	$('#item-new').val('');
            toastr.success(result);        
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});

function Actualizaritem(id)
{	//llamamos a clase que tiene nombre de la id.	 
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/itemsomos/"+id,
        method: 'put',
        data: {
           item: $("."+id+"").val(),
        },
        success: function(result){
        	CargarItem();
        	toastr.success(result);       
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}

function Eliminarconfirmar(id)
{	
	$('.btn-delete').val(id);
	$('#modalDelete').modal('show');
}

jQuery('.btn-delete').click(function(){
	$('#modalDelete').modal('hide');
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/itemsomos/"+$('.btn-delete').val(),
        method: 'delete',
        success: function(result){        	
        	CargarItem();
            toastr.error(result);        
        }
    });
});
