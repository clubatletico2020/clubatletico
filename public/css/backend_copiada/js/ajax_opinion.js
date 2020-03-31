function CargarOpiniones(){
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/opinionesadmin/create",
        method: 'get',
        success: function(result){
            $('.body-opinion').empty();
            $.each(result, function(i,v){
            var date =  moment(v.created_at).format(' DD - MM - Y');            
            $('.body-opinion').append('<tr><td>'+v.titulo+'</td><td>'+date+'</td><td>'+v.estado.estado+'</td><td>'+v.user.name+'</td><td>'+v.comentario_opinion.length+'</td><td align="center"><a href="opinionadmin/'+v.id+'"><button class="btn btn-outline-info btn-xs"><i class="fa fa-comments"></i></button></a><button class="btn btn-outline-primary btn-xs btn-view" onclick="View(this.id)" id="'+v.id+'" style="margin: 2px;"><i class="fa fa-eye"></i></button><a href="opinionesadmin/'+v.id+'/edit"><button class="btn btn-outline-warning btn-xs"><i class="fa fa-edit"></i></button></a><button style="margin: 2px;" class="btn btn-outline-danger btn-xs btn-confirm-delete" onclick="Delete(this.id)" id="'+v.id+'"><i class="fa fa-trash"></i></button></td></tr>');           
            console.log(v);
          });
        }   
    });
}

function CargarArchivo(id){
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/opinionesadminshowarchivo/"+id,
        method: 'get',
        success: function(result){
          $('.archivosshow').empty();
      	  if (result.tipo.tipo_archivo_id == '1') {
      	  	$.each(result.archivos, function(i,v){	
            	$('.archivosshow').append('<div class="row"><div class="col-9"><p>'+v.slug+'</p></div><div class="col-2"><a href="../../storage/'+v.url+'" target="_blank"><button type="button" class="btn btn-outline-primary btn-sm btn-block"><i class="fas fa-file-pdf"></i> Documento</button></a></div><div class="col-1"><button type="button" class="btn btn-outline-danger btn-sm btn-block" id="'+v.id+'" onclick="DeleteArchivo(this.id)"><i class="fa fa-trash"></i></button></div></div>');
          	});
      	  }else if(result.tipo.tipo_archivo_id == '2')
      	  	 $.each(result.archivos, function(i,v){	
            	$('.archivosshow').append('<div class="row"><div class="col-9"><p>'+v.slug+'</p></div><div class="col-2"><a href="../../storage/'+v.url+'" target="_blank"><button type="button" class="btn btn-outline-primary btn-sm btn-block"><i class="fas fa-images"></i> Imagen</button></a></div><div class="col-1"><button type="button" class="btn btn-outline-danger btn-sm btn-block" id="'+v.id+'" onclick="DeleteArchivo(this.id)"><i class="fa fa-trash"></i></button></div></div>');
          	});    
        }   
    });
}
 
$('.tipo_archivo').change(function(e){	
    var tipo = $('.tipo_archivo').val();
    if (tipo == 1) {
      $('.tipo').html('<div class="row"><div class="col-6"><label>Slug Archivo</label><input class="form-control form-control-sm" name="name_archivo[]" required maxlength="43"></div><div class="col-6"><label>Buscar Documento</label><input type="file" name="documento[]" class="form-control form-control-sm" required></div></div>');
      $('.btn-añadir-archivo').html('<button type="button" id="documento" onclick="ArchivoExtra(this.id)" class="btn btn-warning btn-sm btn_archivo_plus">Nuevo</button>');
    }else if(tipo == 2){
      $('.tipo').html('<div class="row"><div class="col-6"><label>Slug Archivo</label><input class="form-control form-control-sm" name="name_archivo[]" required maxlength="43"></div><div class="col-6"><label>Buscar Imagen</label><input type="file" name="imagen[]" class="form-control form-control-sm" required ></div></div>');
      $('.btn-añadir-archivo').html('<button type="button" id="imagen" onclick="ArchivoExtra(this.id)" class="btn btn-warning btn-sm btn_archivo_plus">Nuevo</button>');
    }else{
      $('.tipo').empty();
      $('.btn-añadir-archivo').empty();
    }
});

$('.tipo_archivo_edit').change(function(e){	
    var tipo = $('.tipo_archivo_edit').val();
    var tipo_opinion = $('.archivo_id').val(); //Obetenemos la id del tipo de archivo para mandar alerta si es cambiado.
    if (tipo_opinion != tipo) {
    	$('.alert_archivo').html('<label style="color:red">Precaución</label><p style="color:red">Si cambias el tipo de archivo este reemplazara los archivos anteriores, siendo eliminados.</p>');
    }else{
    	$('.alert_archivo').empty();
    }

    if (tipo == 1) {
      $('.tipo').empty();
      $('.btn-añadir-archivo').html('<button type="button" id="documento" onclick="ArchivoExtra(this.id)" class="btn btn-warning btn-sm btn_archivo_plus">Nuevo</button>');
    }else if(tipo == 2){
      $('.tipo').empty();
      $('.btn-añadir-archivo').html('<button type="button" id="imagen" onclick="ArchivoExtra(this.id)" class="btn btn-warning btn-sm btn_archivo_plus">Nuevo</button>');
    }else{
      $('.tipo').empty();
      $('.btn-añadir-archivo').empty();
      $('.alert_archivo').empty();
    }
});

function ArchivoExtra(id){
	if (id == 'documento') {
		$('.tipo').append('<div class="row"><div class="col-6"><label>Slug Archivo</label><input class="form-control form-control-sm" name="name_archivo[]" required maxlength="43"></div><div class="col-6" ><label>Buscar Documento</label><input type="file" name="documento[]" class="form-control form-control-sm" required ></div></div>');
	}else if(id == 'imagen'){
		$('.tipo').append('<div class="row"><div class="col-6"><label>Slug Archivo</label><input class="form-control form-control-sm" name="name_archivo[]" required maxlength="43"></div><div class="col-6" ><label>Buscar Imagen</label><input type="file" name="imagen[]" class="form-control form-control-sm" required ></div></div>');
	}
}

jQuery('#formOpinion').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/opinionesadmin",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){ 
        	CargarOpiniones();
          $('.tipo').empty();
          $('.btn-añadir-archivo').empty();
          $('#formOpinion')[0].reset();
          $('.textarea_create').empty();
          $('.textarea_create').html('<textarea id="textarea" name="descripcion" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>');        
          $('.textarea').summernote(); 
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

function View(id){
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/opinionesadmin/"+id,
        method: 'get',
        success: function(result){ 
          var date =  moment(result.created_at).format(' DD - MM - Y');
          $('.archivo').empty();          
          $('.titulo').html('<b>'+result.titulo+'</b>');
          $('.descripcion').html('<h6 class="mt-10">'+result.descripcion+'</h6>');
          $('.autor').html('<p>Autor: <small>'+result.user.name+'</small></p>');
          $('.fecha_creacion').html('<div class="form-group"><b>Fecha Creación</b><p><small>'+date+'</small></p>');
          $('.estado').html('<div class="form-group"><b>Fecha Creación</b><p><small>'+result.estado.estado+'</small></p>');
          $('.comentarios').html('<div class="form-group"><b>Comentarios</b><p><small>'+result.comentario_opinion.length+'</small></p>');
          $.each(result.archivo_opinion, function(i,v){
          	if (result.tipo_archivo_id == '1') {
          		$('.archivo').append('<div class="col-4 horas"><div class="form-group"><b>'+v.slug+'</b><p><small><a href="storage/'+v.url+'" target="_blank"><button type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-file-pdf"></i> Documento</button></a></small></p></div>');
          	}else if(result.tipo_archivo_id == '2'){
          		$('.archivo').append('<div class="col-4 horas"><div class="form-group"><b>'+v.slug+'</b><p><img width="60%" src="storage/'+v.url+'"></div>');
          	}            
          });           
          $('#modalView').modal('show');
        }       
    });
}

function DeleteArchivo(id){
	$('#modalDeleteArchivo').modal('show');
	$('.btn-delete-archivo').val(id);
}

jQuery('.btn-delete-archivo').click(function(e){
	$.ajaxSetup({
     	headers: {
        	'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
   	});
    jQuery.ajax({
        url: "/opinionesadminarchivo/"+$(".btn-delete-archivo").val(),
        method: 'delete',
        success: function(result){
        	$('#modalDeleteArchivo').modal('hide');
        	CargarArchivo(result.id);
            toastr.error(result.mensaje);        
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
        url: "/opinionesadmin/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
        	$('#modalDelete').modal('hide');
        	CargarOpiniones();
            toastr.error(result);        
        }
    });
});