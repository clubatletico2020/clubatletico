
function CargaSlider()
{
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/slider/create",
        method: 'get',        
        success: function(result){
          $('.body-slider').empty();
           $.each(result.sliders, function(i,v){           
            $('.body-slider').append('<div class="col col-12 col-lg-4" align="center"><img src="storage/'+v.url+'" class="rounded" width="100%"><div class="row m-2"><div class="col-6 "><select class="form-control form-control-sm block" onchange="UpdateEstado(this.id, this.value)" id="'+v.id+'"></select></div><div class="col-6"><button class="btn btn-outline-danger btn-block btn-sm" onclick="deleteConfirm(this.id)" id="'+v.id+'"><i class="fa fa-trash" ></i></button></div></div></div>');           
            $.each(result.estados, function(y,b){
                if (v.estado_id == b.id) {
                  $('select[id="'+v.id+'"]').append('<option value="'+b.id+'" selected>'+b.estado+'</option>');
                }else{
                  $('select[id="'+v.id+'"]').append('<option value="'+b.id+'">'+b.estado+'</option>');
                }                
            })
          });       
        } 
    });
}

jQuery('#formSlider').on("submit", function(e){
    event.preventDefault();
		$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/slider",
        method: 'POST',
        data:new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(result){
            CargaSlider();
            toastr.success(result);
            $("#formSlider")[0].reset();        
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }
    });
}); 

function UpdateEstado(id, value)
{
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/slider/"+id,
        method: 'put',
        data: {
           estado: value,
        },
        success: function(result){
            toastr.warning(result);        
        },
        error: function(result){
          console.clear();
          $.each(result.responseJSON.errors, function(v,i){
            toastr.warning(i);
          })
        }        
    });
}
 
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
      url: '/slider/'+id,
    success: function(result){
      toastr.error(result);
      CargaSlider();      
    }});
});

