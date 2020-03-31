var storage_imagenes_ = storage_imagenes_eventos();

function CargarFuncionario(){
    $.ajaxSetup({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
      jQuery.ajax({
          url: "/funcionario/create",
          method: 'get',
          success: function(result){
            $('.body-funcionario').empty();
            $.each(result, function(i,v){
            //   alert('Respuesta servidor:'+JSON.stringify(result));
              $('.body-funcionario').append('<tr><td>'+v.nombre+'</td><td style="width:100px; height:100px;"><img  src="'+storage_imagenes_+'/'+v.url+'" align="img" style="width:100%;height:100%;max-height:100%; max-width:100%; border-radius:50%;"></td><td>'+v.cargo+'</td><td>'+v.tipo_funcionario.nombre+'</td><td align="center"><button class="btn btn-outline-info btn-xs" style="margin: 2px;" onclick="View(this.id)" id="'+v.id+'"><i class="fa fa-eye"></i></button><button class="btn btn-outline-warning btn-xs"style="margin: 2px;" onclick="Edit(this.id)" id="'+v.id+'"><i class="fa fa-edit"></i></button><button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id)" id="'+v.id+'" style="margin: 2px;"><i class="fa fa-trash"></i></button></td></tr>');
            });
          }
      });
  }

  /*======================================*/
  //       Comentarios
  /*======================================*/
  /*
  FUNCION QUE ENVIAR EL FORMULARIO PARA GUARDAR UN REGISTRO
  */
    jQuery('#formFuncionario').on("submit", function(e){
        event.preventDefault();
        // alert('agregar formulario');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "/funcionario",
            method: 'POST',
            data:new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(result){
            // alert('Respuesta servidor:'+JSON.stringify(result));
                CargarFuncionario();
                toastr.success(result);
                $("#formFuncionario")[0].reset();
            },
            error: function(result){
            // console.clear();
            // alert('Respuesta servidor:'+JSON.stringify(result));
                $.each(result.responseJSON.errors, function(v,i){
                    toastr.warning(i);
                })
            }
        });
    });

  /*======================================*/
  //       Comentarios
  /*======================================*/
  /*
      Formulario tipo Modal que edita los campos
      de una fila de la tabla y los envia al servidor
      para aactualizarlos.
  */
  jQuery('#formEdit').on("submit", function(e){

    // alert('editando formulario');
      event.preventDefault();
      var id = $('.btn-edit-modal').val();
      $.ajaxSetup({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
      jQuery.ajax({
          url: "/funcionario/"+id,
          method: 'POST',
          data:new FormData(this),
          dataType: 'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success: function(result){
            //   alert('Respuesta servidor:'+JSON.stringify(result));
              CargarFuncionario();
              toastr.success(result);
              $('#modalEdit').modal('hide');
              $("#formEdit")[0].reset();

          },
          error: function(result){
          //   console.clear();
            $.each(result.responseJSON.errors, function(v,i){
              toastr.warning(i);
            })
          }
      });
  });

  /*======================================*/
  //       Comentarios
  /*======================================*/
  /*
  BOTON CLICK PARA MOSTRAR EL MODAL ELIMINAR REGISTRO
  */
  jQuery('.btn-delete').click(function(e){

      var id = $(".btn-delete").val();
      // alert('eliminando con el id:'+id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
      jQuery.ajax({
          url: "/funcionario/"+id,
          method: 'delete',
          success: function(result){
            $('#modalDelete').modal('hide');
            CargarFuncionario();
            toastr.error(result);
          }
      });
  });

  /*======================================*/
  //       Comentarios
  /*======================================*/
  /*
  FUNCION QUE MUESTRA EL MODAL VER
  */

 function View(id){
    // alert('view funcion');

    $.ajaxSetup({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
      jQuery.ajax({
          url: "/funcionario/"+id,
          method: 'get',
          success: function(result){
            // alert("Respuesta servidor:"+JSON.stringify(result));
            $('#modalView').find(".modal-body").find('.img_tipo_funcionario').attr("src", storage_imagenes_+"/"+result.url);
            $('.nombre_funcionario').html(result.nombre);
            $('.cargo_funcionario').html(result.cargo);
            $('.tipo_funcionario').html(result.tipo_funcionario.nombre);
            // alert("Respuesta servidor:"+JSON.stringify(result));
            // alert(storage_imagenes_+"/"+result.url);
            $('#modalView').modal('show');
            // $('#modalView').find(".modal-body").find('.img').attr("src", storage_imagenes_+"/"+result["evento"].url);
            // $('.descripcion').html(result["evento"].descripcion);
            // $('.link_pago').html(result["evento"].link_pago);
            // $('.hora_realizacion').html(result.hora);
            // $('.fecha_realizacion').html(result.fecha_evento);
            // $('.lugar_realizacion').html(result["evento"].lugar_realizacion);
          }
      });
  }

  /*======================================*/
  //       Comentarios
  /*======================================*/
  /*
  MUESTRA EL MODAL ELIMINAR E INCRUSTA EL ID DEL REGISTRO
  SELECCIONADO
  */
  function Delete(id){
      // alert('abriendo el modal Delete');
    $('#modalDelete').modal('show');
    $('.btn-delete').val(id);
  }

  /*======================================*/
  //       Comentarios
  /*======================================*/
  /*
  FUNCION QUE MUESTRA EL MODAL CON LOS DATOS
  CARGADOS EN EL FOMULARIO DE EDITAR
  */
  function Edit(id){

    // alert('edit');
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/funcionario/"+id+"/edit",
        method: 'get',
        success: function(result){
            // alert('Respuesta servidor:'+JSON.stringify(result));
            // alert('Respuesta servidor:'+JSON.stringify(result.nombre));
            $('.btn-edit-modal').attr("value", id);
            $('.id').val(id);
            $('#modalEdit').find(".modal-body").find('.editar_img_tipo_funcionario').attr("src", storage_imagenes_+"/"+result.funcionario.url);
            $('#modalEdit').find(".modal-body").find('.editar_nombre_funcionario').val(result.funcionario.nombre);
            $('#modalEdit').find(".modal-body").find('.editar_cargo_funcionario').val(result.funcionario.cargo);
            $('.editar_tipo_funcionario').empty();

            /**Select Tipo de Funcionario */
            $.each(result.tipo_funcionarios, function(i,v){
                // alert(v.id);
                if (result.funcionario.tipo_funcionario_id == v.id ) {
                $('.editar_tipo_funcionario').append('<option selected value="'+v.id+'">'+v.nombre+'</option>');
                }else{
                $('.editar_tipo_funcionario').append('<option value="'+v.id+'">'+v.nombre+'</option>');
                }
            });
            $('#modalEdit').modal('show');
        }
    });
}
