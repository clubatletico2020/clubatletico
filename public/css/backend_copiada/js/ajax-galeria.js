function CargarGaleria(){
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/galeria/create",
        method: 'get',
        success: function(result){
          $('.body-galeria').empty();
          $.each(result, function(i,v){
              var num = 0;
              $.each(v.imagen, function(f,g){
                num++;
            });              
            $('.body-galeria').append('<tr><td>'+v.nombre+'</td><td>'+num+'</td><td align="center"><div class="row"><div class="col-6"><a href="galeria/'+v.id+'/edit"><button class="btn btn-outline-warning btn-xs"><i class="fa fa-edit"></i></button></a></div><div class="col-6"><button class="btn btn-outline-danger btn-xs" onclick="Delete(this.id)" id="'+v.id+'"><i class="fa fa-trash"></i></button></div></div></td></tr>');   
          });
        }   
    });
}

jQuery('#formGaleria').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/galeria",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargarGaleria();
            toastr.success(result);
            $("#formGaleria")[0].reset();        
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}); 


function Delete(id){
  $('#modalDeleteGaleria').modal('show');
  $('.btn-delete').val(id);
}


jQuery('.btn-delete').click(function(e){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/galeria/"+$(".btn-delete").val(),
        method: 'delete',
        success: function(result){
          $('#modalDeleteGaleria').modal('hide');
          CargarGaleria();
          toastr.error(result);     
        }
    });
});