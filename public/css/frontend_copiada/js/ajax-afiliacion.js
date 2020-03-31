$( document ).ready(function() {
    $('.pdfG').prop('disabled', true);
});

$('.recinto').change(function(){
  var value = $('.recinto').val();
  if (value == '1') {
    $('.body-recinto').html('<div class="col col-6 col-lg-6"><div class="form-group"><label>Hospital</label><input class="form-control form-control-sm" type="text" name="hospital" required="" maxlength="30"></div></div><div class="col col-6 col-lg-6"><div class="form-group"><label>Dirección</label><input class="form-control form-control-sm" type="text" name="direccion_recinto" required="" maxlength="30"></div></div>');
  }else if(value == '2'){
    $('.body-recinto').html('<div class="col col-6 col-lg-4"><div class="form-group"><label>Servicio de Salud</label><input class="form-control form-control-sm" type="text" name="servicio_salud" required="" maxlength="30"></div></div><div class="col col-6 col-lg-4"><div class="form-group"><label>Dirección</label><input class="form-control form-control-sm" type="text" name="direccion_recinto" required="" maxlength="30"></div></div><div class="col col-6 col-lg-4"><div class="form-group"><label>Municipalidad</label><input class="form-control form-control-sm" type="text" name="municipalidad"></div></div>');
  }else if(value == '3'){
    $('.body-recinto').html('<div class="col col-6 col-lg-6"><div class="form-group"><label>Clinica Privada</label><input class="form-control form-control-sm" type="" name="clinica_privada" required="" maxlength="30"></div></div><div class="col col-6 col-lg-6"><div class="form-group"><label>Dirección</label><input class="form-control form-control-sm" type="text" name="direccion_recinto" required="" maxlength="30"></div></div>');
  }else if(value == '4'){
    $('.body-recinto').html('<div class="col col-6 col-lg-4"><div class="form-group"><label>Consultorio Municipal</label><input class="form-control form-control-sm" type="" name="cesfam" required="" maxlength="30"></div></div><div class="col col-6 col-lg-4"><div class="form-group"><label>Dirección</label><input class="form-control form-control-sm" type="text" name="direccion_recinto" required="" maxlength="30"></div></div><div class="col col-6 col-lg-4"><div class="form-group"><label>Municipalidad</label><input class="form-control form-control-sm" type="text" name="municipalidad"></div></div>');
  }else{
    $('.body-recinto').empty();
  }
});

$('#regions').change(function(e){
	var id = $('#regions').val();

	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/getComuna/"+id,
        method: 'get',
        success: function(result){
        	$('.comuna').html('<option value="">Seleccione Comuna</option>');       
        	$.each(result, function(i,v){
          	$('.comuna').append('<option value="'+v.id+'">'+v.name+'</option>');         	
          });
        }   
    });
}); 

jQuery('#formSendAfiliacion').on("submit", function(e){
    event.preventDefault();
    $('.btn_send_afiliacion').prop('disabled', true);
    $('#i_inscripcion').attr('class', 'spinner-border text-info spinner-border-sm');    
    $.ajaxSetup({ 
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/senddocumento",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            toastr.success(result);
            $('#i_afiliacion').attr('class', 'fa fa-send');
            $('.btn_send_afiliacion').prop('disabled', false);
            $("#formSendAfiliacion")[0].reset();
            $('#formulario_envio').modal('hide');        
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
            $('.btn_send_afiliacion').prop('disabled', false);
            $('#i_afiliacion').attr('class', 'fa fa-send');
          })
        }
    });
});
