function CargarImagenes(){
  //sacamos la id del boton submit de editar nombre.
  var id = $('.btn-nombre').prop("id");
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/imagen/"+id,
        method: 'get',
        success: function(result){
          $('.body-imagenes').empty();
          $.each(result, function(i,v){                           
            $('.body-imagenes').append('<div class="col col-6 col-lg-2" align="center"><img src="../../storage/'+v.url+'" width="150px" height="150px" class="rounded" width="100%"><div class="row m-2"><div class="col-12"><button class="btn btn-outline-danger btn-block btn-xs" onclick="deleteConfirm(this.id)" id="'+v.id+'"><i class="fa fa-trash" ></i></button></div></div></div>');   
          });
        }   
    });
}

jQuery('#formNombre').on("submit", function(e){
    event.preventDefault();
    var id = $('.btn-nombre').prop("id");
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/galeria/"+id,
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
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

jQuery('#formImagenes').on("submit", function(e){
    event.preventDefault();  
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/imagen",
        method: 'POST',
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
          CargarImagenes();
          toastr.success(result);
          $("#formImagenes")[0].reset();       
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
});


function deleteConfirm(id)
{
  $('.btn-delete').val(id);
  $('#modalDelete').modal('show');
}

$('.btn-delete').click(function(e){
  var id = this.value;
  $('#modalDelete').modal('hide');
  e.preventDefault();
    
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    }); 
    jQuery.ajax({
      type: 'delete',
      url: '/imagen/'+id,
      success: function(result){
        toastr.error(result);
        CargarImagenes();      
      },
      error:function(result){
        console.clear();
        $.each(result, function(v,i){
            $.each(i.errors, function(g,y){
              toastr.warning(y);
          })
        })
      },
    });
});