@extends('layouts.frontend')

@section('content')

<!-- bradcam_area_start  -->
<div class="bradcam_area breadcam_bg_noticia bradcam_overlay">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Noticias</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bradcam_area_end  -->


<!--================Blog Area =================-->
<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">

                    @foreach ($noticias as $noticia)
                        <article class="blog_item">
                            <div class="blog_item_img">
                            <img class="card-img rounded-100" src="{{asset('storage/'.$noticia->url)}}" alt="">
                                <a href="{{route('web.noticiashow', $noticia->id)}}" class="blog_item_date">
                                    <h3>{{date("d", strtotime($noticia->fecha_realizacion))}}</h3>
                                    <p>{{strftime("%h", strtotime($noticia->fecha_realizacion))}}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{route('web.noticiashow', $noticia->id)}}">
                                <h2>{{$noticia->titulo}}</h2>
                                </a>
                                <ul class="blog-info-link">
                                    <li><a href="{{route('web.noticiashow', $noticia->id)}}"><i class="fa fa-user"></i> {{$noticia->user->name}}</a></li>
                                    <li><a href="{{route('web.noticiashow', $noticia->id)}}"><i class="fa fa-clock-o"></i> {{date("d-m -Y H:i:s", strtotime($noticia->fecha_realizacion))}}</a></li>

                                </ul>
                            </div>
                        </article>    
                    @endforeach                    

                    <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous">
                                    <i class="ti-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form action="#">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder=''
                                        onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Search Keyword'">
                                    <div class="input-group-append">
                                        <button class="btn" type="button"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Buscar</button>
                        </form>
                    </aside>

                    <aside class="single_sidebar_widget newsletter_widget">
                        <h4 class="widget_title">Subscribete</h4>
                        <form id="formSubcripcion" method="POST">
                            @csrf
                            <div class="form-group">
                               <input name="nombre" type="text" class="form-control"placeholder='Nombre' required>
                            </div>
                            <div class="form-group">
                               <input name="correo" type="email" class="form-control"placeholder='Correo electronico' required>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                               type="submit">Subscribe</button>
                         </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->
    
@endsection

@section('js')
<script src="{{asset('frontend/js/ajax-subcripcion.js')}}"></script>
@endsection