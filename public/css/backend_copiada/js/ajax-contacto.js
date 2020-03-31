jQuery('#formContacto').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/contactoadmin",
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

jQuery('#formUbicacion').on("submit", function(e){
    event.preventDefault();
    var dato = $('textarea[name="mapa"]').val().search("iframe");
    if (dato == '-1') {
      toastr.warning("Ingrese una formato valido para el mapa.");
    }else{
      $.ajaxSetup({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
      jQuery.ajax({
          url: "/contactoadmin",
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
    }
});


