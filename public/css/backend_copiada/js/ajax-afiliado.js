function CargarAfiliados()
{
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/afiliacionadmin/create",
        method: 'get',
        success: function(result){
          $('.body-afiliado').empty();
          $.each(result, function(i,v){ 
            var time = new Date(v.created_at);
            var date = time.toLocaleDateString();
            if (v.deleted_at == null) {
              if (v.password == null) {
                $('.body-afiliado').append('<tr><td>'+v.rut+'</td><td>'+v.nombre_completo+'</td><td>'+v.email+'</td><td>+56 9 '+v.celular+'</td><td>'+date+'</td><td><span class="badge badge-success">Afiliado</span></td><td align="center"><button class="btn btn-outline-dark btn-xs pass'+v.id+'" onclick="PasswordIn(this.id)" id="'+v.id+'"><i class="fas fa-lock-open"></i></button><button class="btn btn-outline-warning btn-xs" onclick="Editar(this.id)" id="'+v.id+'"><i class="fa fa-edit"></i></button><button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id) " id="'+v.id+'"><i class="fas fa-minus-circle"></i></button></td></tr>');
              }else{
                $('.body-afiliado').append('<tr><td>'+v.rut+'</td><td>'+v.nombre_completo+'</td><td>'+v.email+'</td><td>+56 9 '+v.celular+'</td><td>'+date+'</td><td><span class="badge badge-success">Afiliado</span></td><td align="center"><button class="btn btn-outline-primary btn-xs" onclick="ChangePassword(this.id)" id="'+v.id+'"><i class="fa fa-key"></i></i></button></i></button><button class="btn btn-outline-warning btn-xs" onclick="Editar(this.id)" id="'+v.id+'"><i class="fa fa-edit"></i></button><button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id) " id="'+v.id+'"><i class="fas fa-minus-circle"></i></button></td></tr>');
              }
              
            }else{
              $('.body-afiliado').append('<tr><td>'+v.rut+'</td><td>'+v.nombre_completo+'</td><td>'+v.email+'</td><td>+56 9 '+v.celular+'</td><td>'+date+'</td><td><span class="badge badge-danger">Desafiliado</span></td><td align="center"><button class="btn btn-outline-success btn-xs" onclick="Activar(this.id) " id="'+v.id+'"><i class="far fa-check-square"></i></button></td></tr>');
            }    
          });        
        }
    });
}

function BuscarAfiliado()
{
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/afiliacionadminBuscar",
        method: 'POST',
        data: {
          buscar: $('input[name="buscar"]').val(),
        },
        success: function(result){
          $('.body-afiliado').empty();
          $.each(result, function(i,v){ 
            var time = new Date(v.fecha_emision);
            var date = time.toLocaleDateString();
            if (v.deleted_at == null) {
              $('.body-afiliado').append('<tr><td>'+v.rut+'</td><td>'+v.nombre_completo+'</td><td>'+v.email+'</td><td>+56 9 '+v.celular+'</td><td>'+date+'</td><td><span class="badge badge-success">Afiliado</span></td><td align="center"><button class="btn btn-outline-warning btn-xs" onclick="Editar(this.id)" id="'+v.id+'"><i class="fa fa-edit"></i></button><button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id) " id="'+v.id+'"><i class="fas fa-minus-circle"></i></button></td></tr>');           
            }else{
              $('.body-afiliado').append('<tr><td>'+v.rut+'</td><td>'+v.nombre_completo+'</td><td>'+v.email+'</td><td>+56 9 '+v.celular+'</td><td>'+date+'</td><td><span class="badge badge-danger">Desafiliado</span></td><td align="center"><button class="btn btn-outline-success btn-xs" onclick="Activar(this.id) " id="'+v.id+'"><i class="far fa-check-square"></i></button></td></tr>');
            }    
          });      
        }
    });
}

function Editar(id){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/afiliacionadmin/"+id,
        method: 'get',
        success: function(result){
          $('#modalEditar').modal('show');
          $('.name').val(result.nombre_completo);
          $('.email').val(result.email);
          $('.phone').val(result.celular);
          $('.btn-editar').val(id);        
        }
    }); 
}

function PasswordIn(id){
  $('.pass'+id).prop('disabled', true);
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/afiliacionadminpassword/"+id,
        method: 'get',
        success: function(result){
          CargarAfiliados();
          toastr.success(result);
        }
    }); 
}

jQuery('#formNuevo').on("submit", function(e){
    event.preventDefault();
    $('.pdfG').prop('disabled', true);
    $('#save_afiliado').attr('class', 'spinner-border text-info spinner-border-sm');
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/afiliacionadmin",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            toastr.success(result);  
            $('#nuevo').modal('hide');    
            CargarAfiliados();  
            $('.pdfG').prop('disabled', false);
            $('#save_afiliado').attr('class', 'fa fa-save');
            $("#formNuevo")[0].reset();
        },
        error: function(result){
          $('.pdfG').prop('disabled', false);
            $('#save_afiliado').attr('class', 'fa fa-save');
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});

jQuery('#formActualizar').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/afiliacionadmin/"+$('.btn-editar').val(),
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            toastr.success(result);  
            $('#modalEditar').modal('hide');    
            CargarAfiliados();  
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});

function Activar(id){
  $('#modalActivar').modal('show');
  $('.btn-activar').val(id);
}

jQuery('.btn-activar').click(function(e){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/afiliacionadminActivar/"+$(".btn-activar").val(),
        method: 'get',
        success: function(result){
          $('#modalActivar').modal('hide');
          CargarAfiliados();
          toastr.success(result);        
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
        url: "/afiliacionadmin/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
          $('#modalDelete').modal('hide');
          CargarAfiliados();
          toastr.error(result);        
        }
    });
});

function ChangePassword(id){
  $('#modalPassword').modal('show');
  $('input[name="id_afiliado"]').val(id);
}

jQuery('#formPassword').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/afiliacionadminpasswordchange",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){            
            if (result.num == 1) {
              toastr.success(result.mensaje);
              $("#formPassword")[0].reset();
              $('#modalPassword').modal('hide');
            }else if(result.num == 0){
              toastr.success(result.mensaje);
              $('input[name="password"]').css('border-color', 'red');
              $('input[name="password_2"]').css('border-color', 'red');              
            }
                    
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}); 
