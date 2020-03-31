@extends('layouts.frontend')

@section('content')

<!-- bradcam_area_start  -->
<div class="bradcam_area breadcam_bg bradcam_overlay">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Conócenos</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bradcam_area_end  -->

<!-- welcome_docmed_area_start -->
<div class="welcome_docmed_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                @if(!empty($somos->url_fundacion))                    
                <img width="100%" src="{{asset('storage/'.$somos->url_fundacion)}}" alt="">
                @endif                   
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="welcome_docmed_info">
                    <h2>HISTORIA</h2>
                    <h5>Club Atletico Chiguayante</h5>
                    @if(!empty($somos->fundacion)) 
                    <p>{!!$somos->fundacion!!}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- welcome_docmed_area_end -->


<!-- business_expert_area_start  -->
<div class="business_expert_area">
    <div class="container">
        <div class="border_bottom">
                <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            
                            <div class="row align-items-center">
                                        <div class="col-xl-6 col-md-6">
                                            <div class="business_info">
                                                <div class="icon">
                                                    <i class="ti ti-bookmark-alt"></i>
                                                </div>
                                                <h3>Misión</h3>
                                                @if(!empty($somos->mision)) 
                                                <p align="justify">{{$somos->mision}}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <div class="business_thumb">
                                                <img src="img/about/business.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        
                      </div>
        </div>

        <div class="border_bottom">
            <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">                        
                        <div class="row justify-content-end">                                    
                                    <div class="col-xl-6 col-md-6">
                                        <div class="business_thumb">
                                            <img src="img/about/business.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="business_info">
                                            <div class="icon">
                                                <i class="ti ti-target"></i>
                                            </div>
                                            <h3>Visión</h3>
                                            @if(!empty($somos->vision)) 
                                            <p align="justify">{{$somos->vision}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                    </div>
                    
                  </div>
        </div>

        <div class="valores_docmed_area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="valores_docmed_info">
                            <h2>Valores</h2>
                            <ul>
                                <div class="row">
                                    @forelse($valores as $valor)
                                    <div class="col-6">
                                    <li> <i class="flaticon-right"></i>{{$valor->descripcion}}</li>
                                    </div>                                    
                                    @empty
                                        <p>Sin valores definidos.</p>
                                    @endif
                                </div>                      
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- business_expert_area_end  -->


<!-- expert_doctors_area_start -->
<div class="expert_doctors_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="doctors_title mb-55">
                    <h3>Directorio</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="expert_active owl-carousel">
                    @foreach($funcionarios as $item)
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