jQuery('.access').change(function(){
  $('.noaccess').prop('checked', false);
  $('.free').prop('checked', false);
});

jQuery('.noaccess').change(function(){
  $('.access').prop('checked', false);
  $('.free').prop('checked', false);
});

jQuery('.free').change(function(){
  $('.access').prop('checked', false);
  $('.noaccess').prop('checked', false);
});

jQuery(document).ready(function() {
    jQuery('#showCheckoutHistory').change(function() {
        if ($(this).prop('checked')) {
            alert("You have elected to show your checkout history."); //checked
        }
        else {
            alert("You have elected to turn off checkout history."); //not checked
        }
    });
});

jQuery('#modalPass').on('hidden.bs.modal', function (e) {
  $('.pass_1').val('');
  $('.repetir_1').val('');
  $('.update-user').prop('disabled', true);
});

$(".repetir" ).keyup(function() {
  if ($('.pass').val() == this.value) {
    $('.añadir-user').prop( "disabled", false );
    $(this).css('border','1px solid #ced4da');

  }else{
    $('.añadir-user').prop( "disabled", true );
    $(this).css('border','1px solid red');
  }
});

$(".repetir_1" ).keyup(function() {
  if ($('.pass_1').val() == this.value) {
    $('.update-user').prop( "disabled", false );
    $(this).css('border','1px solid #ced4da');

  }else{
    $('.update-user').prop( "disabled", true );
    $(this).css('border','1px solid red');
  }
});

function CargarUsuario(){
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/usuario/create",
        method: 'get',
        success: function(result){
          $('.body-usuario').empty();
            $.each(result, function(i,v){
            $('.body-usuario').append('<tr><td>'+v.name+'</td><td>'+v.email+'</td><td align="center"><a href="usuario/'+v.id+'/edit"><button class="btn btn-outline-warning btn-xs"style="margin: 2px;"><i class="fa fa-edit"></i></button></a><button class="btn btn-outline-info btn-xs" style="margin: 2px;" onclick="Pass(this.id)" id="'+v.id+'"><i class="fa fa-key"></i></button><button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id)" id="'+v.id+'" style="margin: 2px;"><i class="fa fa-trash"></i></button></td></tr>');           
          });          
        }   
    });
}

jQuery('#formUsuario').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/usuario",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){ 
            CargarUsuario();       
            toastr.success(result);
            $("#formUsuario")[0].reset();        
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
        url: "/usuario/"+id,
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarUsuario();
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

function Edit(id){
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/usuario/"+id+"/edit",
        method: 'get',
        success: function(result){
        $('#modalEdit').modal('show');
            $('.btn-edit-modal').attr("value", id);
            $('.name').val(result.name);
            $('.email').val(result.email);  
            $('.id').val(result.id);       
        }       
    });
}

function Pass(id){  
   $('#modalPass').modal('show');
   $('.btn-password-modal').attr("value", id); 
}

jQuery('#formPassword').on("submit", function(e){
    event.preventDefault();
    var id = $('.btn-password-modal').val();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    
    jQuery.ajax({
        url: "/password/"+id,
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            toastr.success(result);
            $('#modalPass').modal('hide');
            $("#formPassword")[0].reset();            
        },
        error: function(result){
          // console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});


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
        url: "/usuario/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
          $('#modalDelete').modal('hide');
          CargarUsuario();
          toastr.error(result);        
        }
    });
});