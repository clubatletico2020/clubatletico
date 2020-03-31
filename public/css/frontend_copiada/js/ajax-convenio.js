$('.convenioshow').on('click', function(){
	var id = this.id;
	$.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/convenioshow/"+id,
        method: 'get',
        success: function(result){
        $('.modaltitulo').html(result.titulo);
        $('.modal-show').html(result.descripcion);
        $('#exampleModal').modal('show');         
        }   
    });
});