function CargarAlianzas(){
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/alianza/create",
        method: 'get',
        success: function(result){
        	$('.body-alianza').empty();
        	$.each(result, function(i,v){
          	$('.body-alianza').append('<div class="col col-12 col-lg-3" align="center"><img src="storage/'+v.url_imagen+'" class="rounded" style="width: 100%; height: 150px;"><div class="row m-2"><div class="col-6"><button class="btn btn-outline-warning btn-block btn-xs" onclick="Edit(this.id)" id="'+v.id+'"><i class="fa fa-edit" ></i></button></div><div class="col-6"><button class="btn btn-outline-danger btn-block btn-xs" onclick="Delete(this.id)" id="'+v.id+'"><i class="fa fa-trash" ></i></button></div></div></div>');         	
          });
        }  	
    });
}

jQuery('#formAlianza').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/alianza",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarAlianzas();
            toastr.success(result);
            $("#formAlianza")[0].reset();        
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
        url: "/alianza/"+id,
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarAlianzas();
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

function Edit(id){
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/alianza/"+id+"/edit",
        method: 'get',
        success: function(result){
            $('.btn-edit-modal').attr("value", id);
            $('.img-show').attr('src', 'storage/'+result.url_imagen+'');
            $('.url').val(result.url_destino);            
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
        url: "/alianza/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
          $('#modalDelete').modal('hide');
          CargarAlianzas();
          toastr.error(result);        
        }
    });
});