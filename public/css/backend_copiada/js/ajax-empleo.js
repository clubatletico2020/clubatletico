function CargarEmpleo(){
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/empleo/create",
        method: 'get',
        success: function(result){
            $('.body-empleo').empty();
            $.each(result, function(i,v){
            $('.body-empleo').append('<tr><td>'+v.titulo+'</td><td>'+v.user.name+'</td><td align="center"><button class="btn btn-outline-primary btn-xs" style="margin-right: 3px;" onclick="View(this.id)" id="'+v.id+'"><i class="fa fa-eye"></i></button><button class="btn btn-outline-warning btn-xs" onclick="Edit(this.id)" id="'+v.id+'" ><i class="fa fa-edit"></i></button><button class="btn btn-outline-danger btn-xs" style="margin-left: 3px;" onclick="Delete(this.id) " id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');           
          });
        }   
    });
}

jQuery('#formEmpleo').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {  
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/empleo",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarEmpleo();
            toastr.success(result);
            $("#formEmpleo")[0].reset();
            $('.textarea_edit').empty();
            $('.textarea_edit').html('<textarea id="textarea" name="descripcion" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>');        
            $('.textarea').summernote();       
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
        url: "/empleo/"+id,
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarEmpleo();
            toastr.success(result);
            $("#formEmpleo")[0].reset(); 
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
        url: "/empleo/"+id,
        method: 'get',
        success: function(result){
          $('.img').html('<img class="form-control" src="storage/'+result.url+'" style="height: 250px; width: 350px;">');
          $('.titulo').html('<b>'+result.titulo+'</b>');
          $('.descripcion').html('<h6 class="mt-10">'+result.descripcion+'</h6>');
          $('.autor').html('<p>Autor: <small>'+result.user.name+'</small></p>');
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
        url: "/empleo/"+id+"/edit",
        method: 'get',
        success: function(result){
        $('#modalEdit').modal('show');
            $('.btn-edit-modal').attr("value", id);
            $('.titulo').val(result.titulo);
            $('.id').val(id);
            $('.autor').val(result.user.name);
            $('.text').html('<label>Descripción</label><textarea id="textarea" name="descripcion" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">'+result.descripcion+'</textarea>');
            $("#modalEdit").on('shown.bs.modal', function(){
            $('.textarea').summernote();
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
        url: "/empleo/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
        	$('#modalDelete').modal('hide');
        	CargarEmpleo();
            toastr.error(result);        
        }
    });
});