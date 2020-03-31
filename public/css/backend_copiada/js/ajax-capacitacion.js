function format(input)
{
    var num = input.value.replace(/\./g,'');
    if(!isNaN(num)){
      num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
      num = num.split('').reverse().join('').replace(/^[\.]/,'');
      input.value = num;
    }else{ 
      alert('Solo se permiten numeros');
      input.value = input.value.replace(/[^\d\.]*/g,'');
    }
}

function CargarCapacitacion(){
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    }); 
    jQuery.ajax({
        url: "/capacitacionadmin/create",
        method: 'get',
        success: function(result){
            $('.body-capacitacion').empty();
            $.each(result, function(i,v){
            var time = new Date(v.fecha_emision);
            var date = time.toLocaleDateString();
            if (v.fecha_emision == null) {
              var date = 'no definida'
            }else{
              var date = time.toLocaleDateString();
            }             
            $('.body-capacitacion').append('<tr><td>'+v.titulo+'</td><td>'+date+'</td><td>'+v.estado.estado+'</td><td>'+v.user.name+'</td><td align="center"><a href="reservacapacitacion/'+v.id+'}}"><button type="button" class="btn btn-xs btn-outline-success">'+v.reservcapacitacion.length+'</button></a></td><td align="center"><a href="comentarioadmin/'+v.id+'"><button class="btn btn-outline-info btn-xs"><i class="fa fa-comments"></i></button></a><button class="btn btn-outline-primary btn-xs btn-view" onclick="View(this.id)" id="'+v.id+'" style="margin: 2px;"><i class="fa fa-eye"></i></button><a href="capacitacionadmin/'+v.id+'/edit"><button class="btn btn-outline-warning btn-xs"><i class="fa fa-edit"></i></button></a><button style="margin: 2px;" class="btn btn-outline-danger btn-xs btn-confirm-delete" onclick="Delete(this.id)" id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');           
          });
        }   
    });
}

jQuery('#formCapacitacion').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/capacitacionadmin",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){ 
            CargarCapacitacion();           
            toastr.success(result);
            $("#formCapacitacion")[0].reset();
            $('.textarea_edit').empty();
            $('.textarea_edit').html('<textarea id="textarea" name="temario" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>');        
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

function View(id){
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/capacitacionadmin/"+id,
        method: 'get',
        success: function(result){
        var time = new Date(result.fecha_emision);    
        var date = time.toLocaleDateString();
          $('.img').html('<img class="form-control" src="storage/'+result.url+'" style="height: 250px; width: 350px;">');
          $('.titulo').html('<b>'+result.titulo+'</b>');
          $('.temario').html('<h6 class="mt-10">'+result.temario+'</h6>');
          $('.autor').html('<p>Autor: <small>'+result.user.name+'</small></p>');
          $('.precio_socio').html('<div class="form-group"><b>Pre. socio</b><p><small>'+result.precio_socio+'</small></p>');
          $('.precio_no_socio').html('<div class="form-group"><b>Pre. no socio</b><p><small>'+result.precio_no_socio+'</small></p>');
          $('.precio_estudiante').html('<div class="form-group"><b>Pre. estudiante</b><p><small>'+result.precio_estudiante+'</small></p>');
          $('.direccion').html('<p>Dirección: <small>'+result.direccion+'</small></p>');
          $('.horas').html('<p>Horas: <small>'+result.horas+'</small></p>');
          $('.fecha').html('<p>Fecha emisión: <small>'+result.time+'</small></p>');
          $('.estado').html('<p>Estado: <small>'+result.estado.estado+'</small></p>');
         $('#modalView').modal('show');
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
        url: "/capacitacionadmin/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
        	$('#modalDelete').modal('hide');
        	CargarCapacitacion();
            toastr.error(result);        
        }
    });
});