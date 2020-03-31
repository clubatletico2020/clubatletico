$(document).ready(function(){
    $('#modalEdit').on('shown', function(){
        $('#textarea').wysihtml5();
    });
});

function CargarConvenio(){
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/convenioadmin/create",
        method: 'get',
        success: function(result){
        	$('.body-convenio').empty();
        	$.each(result, function(i,v){
          	$('.body-convenio').append('<tr><td>'+v.titulo+'</td><td>'+v.estado.estado+'</td><td align="center"><button class="btn btn-outline-primary btn-xs btn-view" onclick="View(this.id)" id="'+v.id+'" style="margin: 2px;"><i class="fa fa-eye"></i></button><button style="margin: 2px;" class="btn btn-outline-warning btn-xs btn-view-edit" onclick="Edit(this.id)" id="'+v.id+'"><i class="fa fa-edit"></i></button><button style="margin: 2px;" class="btn btn-outline-danger btn-xs btn-confirm-delete" onclick="Delete(this.id)" id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');         	
          });
        }  	
    });
}

jQuery('#formConvenio').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/convenioadmin",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarConvenio();
            toastr.success(result);
            $("#formConvenio")[0].reset();
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
        url: "/convenioadmin/"+id,
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarConvenio();
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
        url: "/convenioadmin/"+id,
        method: 'get',
        success: function(result){
          $('.img').html('<img class="form-control" src="storage/'+result.url+'" style="height: 250px; width: 350px;">');
          $('.cargo').html('<b>'+result.titulo+'</b>');
          $('.name').html('<h6 class="mt-10">'+result.descripcion+'</h6>');
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
        url: "/convenioadmin/"+id+"/edit",
        method: 'get',
        success: function(result){
        $('#modalEdit').modal('show');
            $('.btn-edit-modal').attr("value", id);
            $('.titulo').val(result.convenio.titulo);
            $('.id').val(id);
            $('.text').html('<label>Descripción</label><textarea id="textarea" name="descripcion" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">'+result.convenio.descripcion+'</textarea>');
            $('.select-estado').empty();
          $.each(result.estados, function(i,v){
            if (result.convenio.estado.id == v.id ) {
              $('.select-estado').append('<option selected value="'+v.id+'">'+v.estado+'</option>');
            }else{
              $('.select-estado').append('<option value="'+v.id+'">'+v.estado+'</option>');
            }                     
            });
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
        url: "/convenioadmin/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
          $('#modalDelete').modal('hide');
          CargarConvenio();
          toastr.error(result);        
        }
    });
});