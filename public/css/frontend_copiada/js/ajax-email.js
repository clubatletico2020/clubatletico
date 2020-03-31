jQuery('.btn-send').click(function(){	
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/sendmail",
        method: 'post',
        data:{
        	name: $('#name').val(),
        	email: $('#email').val(),
        	motivo: $('#motivo').val(),
        	mensaje: $('#mensaje').val(),
        },
        success: function(result){
            toastr.success("Mensaje enviado, te responderemos a la brevedad.");
        	$('#name').val('');
            $('#email').val('');
            $('#motivo').val('');
            $('#mensaje').val('');         
        }   
    });
});