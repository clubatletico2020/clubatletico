<?php
//---------ROUTE FRONTEND--------------//

Route::get('/', 'WebController@Home')->name('web.home');
Route::get('conocenos', 'WebController@Conocenos')->name('web.conocenos');
Route::get('eventos', 'WebController@Eventos')->name('web.eventos');
Route::get('eventos/{id}', 'WebController@ShowEvento')->name('web.eventoshow');
Route::get('noticias', 'WebController@Noticias')->name('web.noticias');
Route::get('noticias/{id}', 'WebController@ShowNoticia')->name('web.noticiashow');
Route::get('contactenos', 'WebController@Contacto')->name('web.contacto');
Route::post('suscribirme', 'WebController@Suscripcion')->name('web.suscripcion');

Route::get('pdf',function(){
	$data = array();
	$pdf = \PDF::loadView('/home', $data);
	return $pdf->download('invoice.pdf');
});

//-----------------ROUTE BACKEND---------------//

Auth::routes();


Route::resource('/usuario', 'UsuarioController')->except('show')->middleware('can:usuariogestion');
Route::resource('/administracion', 'AdministrableController')->only('index');
Route::resource('/slider', 'SliderController')->only('index', 'create','store','update','destroy')->middleware('can:slidergestion');
Route::resource('/somos', 'SomosController')->only('index','create','store','destroy')->middleware('can:somosgestion');
Route::resource('/evento', 'EventoController')->middleware('can:eventogestion');
Route::resource('/noticia', 'NoticiaController')->middleware('can:noticiagestion');
Route::resource('/valor', 'ValorController')->only('index','create','store','destroy')->middleware('can:valoresgestion');
Route::resource('/suscripcion', 'SuscripcionController')->middleware('can:suscripciongestion');

Route::resource('/contacto'         , 'ContactoController')->middleware('can:contactogestion');

Route::resource('/funcionario'      , 'FuncionarioController')->middleware('can:funcionariogestion');
Route::resource('/galeria', 'GaleriaController')->except('show')->middleware('can:galeriagestion');
Route::resource('/imagen', 'ImagenController')->only('show', 'store', 'destroy')->middleware('can:galeriagestion');


/**/
Route::get('upload_image', function () {
    return view("plugins.index");
});
