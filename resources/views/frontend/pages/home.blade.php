@extends('layouts.frontend')

@section('content')

@include('frontend.parciales.slider')

<!-- offers_area_start -->
<div class="our_department_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-55">
                    <h3>Eventos</h3>
                    <p>Esto son algunos de nuestros eventos que tenemos para ti.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($eventos as $evento)
            <div class="col-xl-4 col-md-6 col-lg-4">
                <div class="single_department">
                    <div class="department_thumb">
                        <img height="230px" src="{{asset('storage/'.$evento->url)}}" alt="">
                    </div>
                    <div class="department_content">
                        <h5><a href="#">{{$evento->titulo}}</a></h5>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <p> <small> <i class="fa fa-user"></i> {{$evento->user->name}}</small></p>
                            </div>
                            <div class="col-6 text-right">
                                <p><small><i class="fa fa-clock-o"></i> {{date("d-m -Y", strtotime($evento->fecha_realizacion))}}</small></p>
                            </div>
                        </div>            
                        <a href="#" class="learn_more">Leer más</a>
                    </div>
                </div>
            </div>
            @empty

            @endforelse
        </div>
    </div>
</div>
<!-- offers_area_end -->

<!-- testmonial_area_start -->
<div class="testmonial_area">
    <div class="testmonial_active owl-carousel">
        <div class="single-testmonial testmonial_bg_1 overlay2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="testmonial_info text-center">
                            <div class="quote">
                                <i class="flaticon-straight-quotes"></i>
                            </div>
                            <p>Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br>
                                sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.
                                <br>
                                Fusce ac mattis nulla. Morbi eget ornare dui. </p>
                            <div class="testmonial_author">
                                <h4>Asana Korim</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-testmonial testmonial_bg_2 overlay2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="testmonial_info text-center">
                            <div class="quote">
                                <i class="flaticon-straight-quotes"></i>
                            </div>
                            <p>Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br>
                                sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.
                                <br>
                                Fusce ac mattis nulla. Morbi eget ornare dui. </p>
                            <div class="testmonial_author">
                                <h4>Asana Korim</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-testmonial testmonial_bg_1 overlay2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="testmonial_info text-center">
                            <div class="quote">
                                <i class="flaticon-straight-quotes"></i>
                            </div>
                            <p>Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br>
                                sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.
                                <br>
                                Fusce ac mattis nulla. Morbi eget ornare dui. </p>
                            <div class="testmonial_author">
                                <h4>Asana Korim</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- testmonial_area_end -->


<div class="our_department_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-55">
                    <h3>Noticias</h3>
                    <p>Mantente informado sobre las noticas mas recientes.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($noticias as $noticia)
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="single_department">
                        <div class="department_thumb">
                        <img height="200px" src="{{asset('storage/'.$noticia->url)}}" alt="">
                        </div>
                        <div class="department_content">
                            <h5><a href="#">{{$noticia->titulo}}</a></h5>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <p> <small> <i class="fa fa-user"></i> {{$noticia->user->name}}</small></p>
                                </div>
                                <div class="col-6 text-right">
                                    <p><small><i class="fa fa-clock-o"></i> {{date("d-m -Y", strtotime($noticia->fecha_realizacion))}}</small></p>
                                </div>
                            </div>
                            <a href="#" class="learn_more">Leer más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>




<!-- expert_doctors_area_start -->
<div class="expert_doctors_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="doctors_title mb-55">
                    <h3>Entrenadores</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="expert_active owl-carousel">
                    @foreach ($funcionarios as $item)
                        <div class="single_expert">
                            <div class="expert_thumb">
                                <img height="300px" src="{{asset('storage/'.$item->url)}}" alt="">
                            </div>
                            <div class="experts_name text-center">
                                <h3>{{$item->nombre}}</h3>
                                <span>{{$item->cargo}}</span>
                            </div>
                        </div>
                    @endforeach           
                </div>
            </div>
        </div>
    </div>
</div>
<!-- expert_doctors_area_end -->

<!-- Emergency_contact start -->
<div class="Emergency_contact">
    <div class="conatiner-fluid p-0">
        <div class="row no-gutters">
            <div class="col-xl-6">
                <div class="single_emergency d-flex align-items-center justify-content-center emergency_bg_1 overlay_skyblue">
                    <div class="info">
                        <h3>Llamanos.</h3>
                        <p>Comunicate con nosotros para mas información.</p>
                    </div>
                    <div class="info_button">
                        <a href="#" class="boxed-btn3-white">+56 9 1234 5678</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="single_emergency d-flex align-items-center justify-content-center emergency_bg_2 overlay_skyblue">
                    <div class="info">
                        <h3>Escribenos.</h3>
                        <p>Dejanos tu mensaje en nuestro correo electronico.</p>
                    </div>
                    <div class="info_button">
                        <a href="#" class="boxed-btn3-white">Escribir Mensaje</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Emergency_contact end -->

@endsection