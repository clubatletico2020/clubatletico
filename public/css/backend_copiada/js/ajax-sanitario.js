$(document).ready(function(){
    $('#modalEdit').on('shown', function(){
        $('#textarea').wysihtml5();
    });
});

function CargarSanitario(){
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/sanitario/create",
        method: 'get',
        success: function(result){
        	$('.body-sanitario').empty();
        	$.each(result, function(i,v){
          	$('.body-sanitario').append('<tr><td>'+v.slug+'</td><td>'+v.titulo+'</td><td>'+v.created_at+'</td><td align="center"><button class="btn btn-outline-primary btn-xs btn-view" onclick="View(this.id)" id="'+v.id+'" style="margin: 2px;"><i class="fa fa-eye"></i></button><button style="margin: 2px;" class="btn btn-outline-warning btn-xs btn-view-edit" onclick="Edit(this.id)" id="'+v.id+'"><i class="fa fa-edit"></i></button><button style="margin: 2px;" class="btn btn-outline-danger btn-xs btn-confirm-delete" onclick="Delete(this.id)" id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');         	
          });
        }  	
    });
}

jQuery('#formSanitario').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/sanitario",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarSanitario();
            toastr.success(result);
            $("#formSanitario")[0].reset();
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
        url: "/sanitario/"+id,
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarSanitario();
            toastr.success(result);
            $('#modalEdit').modal('hide');
            $("#formEdit")[0].reset();
            
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
        url: "/sanitario/"+id,
        method: 'get',
        success: function(result){
          if (result.url) {
          $('.img').html('<img class="form-control" src="storage/'+result.url+'" style="height: 250px; width: 350px;">');
          }
          $('.slug').html('<b>'+result.slug+'</b>');
          $('.descripcion').html('<h6 class="mt-10" align="justify">'+result.descripcion+'</h6>');
          $('.titulo').html('<b>'+result.titulo+'</b>');
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
        url: "/sanitario/"+id+"/edit",
        method: 'get',
        success: function(result){
        $('#modalEdit').modal('show');
            $('.btn-edit-modal').attr("value", id);
            $('.slug').val(result.slug);
            $('.titulo').val(result.titulo);
            $('.id').val(id);
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
        url: "/sanitario/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
          $('#modalDelete').modal('hide');
          CargarSanitario();
          toastr.error(result);        
        }
    });
});