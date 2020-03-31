jQuery('#formRedesSociales').on("submit", function(e){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/rrss/1",
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