/*===========================================================================*/
// Se crean los campos de texto con los valores guardados en la base de datos
/*===========================================================================*/
// imprimirItemsValores();
function imprimirItemsValores(valores_db)
{
  /* Act on the event */
  /*
  var wrapper       = $(".wrapper_valores"); //Fields wrapper
  var cantidad      = 2;

  for (var i = 0; i <cantidad; i++) {
    $(wrapper).append(
      '<div class="row">'+
        '<div class="col-sm-2 col-md-2 col-lg-2 text-right form-group" style="border:0px solid black;">'+
           '<label>Descripción</label>'+
        '</div>'+
        '<div class="col-sm-7 col-md-7 col-lg-7" style="border:0px solid black;">'+
            '<input type="text" name="descripcion_valor" class="form-control" value="'+valores_db+'">'+
        '</div>'+
        '<div class="col-sm-3 col-md-3 col-lg-3" style="border:0px solid black;">'+
            '<div style="padding:4px 0px 4px 0px;border:0px solid black;">'+
              '<button type="button" class="btn btn-outline-danger btn-sm btn-delete-imagen remove_field"><i class="fa fa-trash"></i> Eliminar</button>'+
            '</div>'+
        '</div>'+
      '</div>'
    );
  }
  */
}



/*===========================================================================*/



function CargarImagen(){
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/somos/create",
        method: 'get',
        success: function(result){
          if (result.url.length != 0) {
            $(".body-img").html('<img class="w-50 rounded" src="storage/'+result.url+'" align="img">');
            $('.body-button-delete').append('<button type="button" class="btn btn-outline-danger btn-sm btn-delete-imagen" onclick="DeleteImagen()"><i class="fa fa-trash"></i> Eliminar Imagen</button>');
          }          
        }   
    });
}

function CargarDocumento(){
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/somos/createDocumento",
        method: 'get',
        success: function(result){
          if (result.length == 0) {
              $(".body-doc").html('<p><small>Sin información cargada.</small></p>');
          }else{
            if (result.tipo_archivo_id == 1) {
              $(".body-doc").html('<p><small>Tienes cargado un documento. </small></p>');
            }else if(result.tipo_archivo_id == 2){
              $('.body-doc').html('<p><small>Tienes cargada una imagen. </small></p>');
            }
          }          
        }   
    });
}

jQuery('#formSomos').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/somos",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarImagen();          
            toastr.success(result);
            $(".imagen_somos").val('');        
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}); 

jQuery('#formDirectorio').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/somosDocumento/1",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){          
            toastr.success(result);
            CargarDocumento();
            $(".tipo").empty();
            $('.tipo_archivo').val('');


        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}); 

$('.tipo_archivo').change(function(e){	
    var tipo = $('.tipo_archivo').val();
    if (tipo == 1) {
      $('.tipo').html('<label>Buscar Documento</label><input type="file" name="documento" class="form-control form-control-sm" required >');
    }else if(tipo == 2){
      $('.tipo').html('<label>Buscar Imagen</label><input type="file" name="imagen" class="form-control form-control-sm" required>');
    }else{
      $('.tipo').empty();
    }
});

function DeleteImagen()
{
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/somos/1",
        method: 'delete',
        success: function(result){
         $('.body-img').empty();
         $('.btn-delete-imagen').hide();
         toastr.error(result);
        }       
    });
}




/*============================================================*/
//       FUNCIONALIDAD DE BOTON CREAR VALORES EN QUIENESSOMOS
/*============================================================*/
/*
  Comentarios
*/

$("#boton_nuevo_valor").click(function(event) {
  /* Act on the event */
  generarItemsValores();
});

function generarItemsValores()
{
  /* Act on the event */
  var wrapper       = $(".wrapper_valores"); //Fields wrapper

  $(wrapper).append(
    '<div class="row">'+
      '<div class="col-sm-2 col-md-2 col-lg-2 text-right form-group" style="border:0px solid black;">'+
         '<label>Descripción</label>'+
      '</div>'+
      '<div class="col-sm-7 col-md-7 col-lg-7" style="border:0px solid black;">'+
          '<input type="text" name="descripcion_valor" class="form-control" data-con_boton_eliminar="si">'+
      '</div>'+
      '<div class="col-sm-3 col-md-3 col-lg-3" style="border:0px solid black;">'+
          '<div style="padding:4px 0px 4px 0px;border:0px solid black;">'+
            '<button type="button" class="btn btn-outline-danger btn-sm btn-delete-imagen remove_field"><i class="fa fa-trash"></i> Eliminar</button>'+
          '</div>'+
      '</div>'+
    '</div>'
  );
  /*================================================================================*/
  /*Elimina los campos de texto creados por ajax en la seccion VALORES*/
  /*================================================================================*/
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove();
  });
}


/*================================================================================*/
/*
      Elimina los campos de texto con sus contenidos traidos de la TABLA SQL VALORES e 
      imprimidos por el foreach de blade en la seccion VALORES.                 
*/
/*================================================================================*/
$(".remove_field").click( function(e){ //user click on remove text
    e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove();
  });


/*================================================================================*/
/*Actualizando y enviando el formulario con los valores de la pagina Quienes Somos*/
/*================================================================================*/

jQuery('#formSomosItemsValores').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    /*============================*/
    // OBTENIENDO TODOS LOS VALORES
    /*============================*/
    var valores = Array();
    var tiene_boton_eliminar = "";
    var primer_campo_texto_vacio = 1;  // esta vacio
    $('input[name^="descripcion_valor"]').each(function() {
        // alert($(this).val());
        tiene_boton_eliminar = $(this).attr('data-con_boton_eliminar');
        // se captura el valor del campo de texto
        var item = $(this).val();
        // se valida que se capturen los campos de texto que no esten vacios.
        if(item!="")
        {
          valores.push(item);
        }  // Se borraran todos los campos de texto vacios que tengao boton de eliminar
        else if(item=="" && tiene_boton_eliminar=="si")
        {
          $(this).parent('div').parent('div').remove();
        }  // Cuando el primer campo de texto este lleno se avisara.
        else if(item!="" && tiene_boton_eliminar=="no")
        {
          primer_campo_texto_vacio = 0;
        }
        
    });

    // alert(valores.length);

    // console.log(valores);
    // console.log(primer_campo_texto_vacio);

    /*
    // Si el primer campo esta vacio entonces eliminarlo si es que otro campo de texto no esta vacio
    if(primer_campo_texto_vacio==1 && valores.length>1)
    {
      $('input[name^="descripcion_valor"]').each(function() {
          tiene_boton_eliminar = $(this).attr('data-con_boton_eliminar');

          if(tiene_boton_eliminar=="no")
          {
            $(this).parent('div').parent('div').remove();
          }
      });
    }
    */
    /*============================*/
    //          FIN
    /*============================*/
    var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
    
    jQuery.ajax({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        url: "/valor",
        method: 'POST',
        data:{valores:valores,_token:CSRF_TOKEN},
        dataType: 'JSON',
        success: function(result){
            // alert("ok");
            // CargarImagen();          
            toastr.success("información actualizada exitosamente");
            // $(".imagen_somos").val('');  
            // alert("Respuesta servidor:"+JSON.stringify(result));
            // alert(result);
            // imprimirItemsValores(result);    
        },
        error: function(result){
          // console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});

/*======================================*/
//       FIN
/*======================================*/



