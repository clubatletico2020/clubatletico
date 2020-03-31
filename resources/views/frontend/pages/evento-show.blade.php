@extends('layouts.frontend')

@section('content')

<!-- bradcam_area_start  -->
<div class="bradcam_area breadcam_bg_evento bradcam_overlay">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Evento</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bradcam_area_end  -->
   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section-padding">
    <div class="container">
       <div class="row">
          <div class="col-lg-8 posts-list">
             <div class="single-post">
                <div class="feature-img">
                   <img class="img-fluid" src="{{asset('storage/'.$evento->url)}}" alt="">
                </div>
                <div class="blog_details">
                   <h2>
                      {{$evento->titulo}}
                   </h2>
                   <ul class="blog-info-link mt-3 mb-4">
                      <li><a href="#"><i class="fa fa-user"></i> {{$evento->user->name}}</a></li>
                      <li><a href="#"><i class="fa fa-clock-o"></i> {{date("d-m -Y H:i:s", strtotime($evento->fecha_realizacion))}}</a></li>
                   </ul>
                   {!!$evento->descripcion!!}
                   <div class="quote-wrapper">
                      <div class="quotes">
                         Estimado usuario, al realizar el pago de su inscripción a este evento, debe enviar el comprobante de pago al correo
                         "inscripciones@clubatleticochiguayate.cl", con el fin de aseguridad su reserva.
                      </div>
                   </div> 
                   <div class="row text-center">                   
                        <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn btn-pago"
                   type="button" value="{{$evento->link_pago}}"><i class="fa fa-shopping-cart"></i> Pagar Inscripción</button>                    
                   </div>                  
                </div>
             </div>
             <div class="navigation-top">
                <div class="d-sm-flex justify-content-between text-center">
                   <p class="like-info"><span class="align-middle"><i class="fa fa-share-alt "></i></span> Compartir</p>
                   <div class="col-sm-4 text-center my-2 my-sm-0">

                   </div>
                   <ul class="social-icons">
                      <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                      <li><a href="#"><i class="fa fa-behance"></i></a></li>
                   </ul>
                </div>
                <div class="navigation-area">
                   <div class="row">
                      <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">                         
                         @if(!empty($prev)) 
                         <div class="arrow">
                            <a href="{{route('web.eventoshow', $prev->id)}}">
                               <span class="lnr text-white ti-arrow-left"></span>
                            </a>
                         </div>
                         <div class="detials">
                            <p>Anterior</p>
                            <a href="{{route('web.eventoshow', $prev->id)}}">
                               <h4>{{$prev->titulo}}</h4>
                            </a>
                         </div>
                        @endif
                      </div>
                      <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                        @if(!empty($next))  
                         <div class="detials">
                            <p>Siguiente</p>
                            <a href="{{route('web.eventoshow', $next->id)}}">
                               <h4>{{$next->titulo}}</h4>
                            </a>
                         </div>
                         <div class="arrow">
                            <a href="{{route('web.eventoshow', $next->id)}}">
                               <span class="lnr text-white ti-arrow-right"></span>
                            </a>
                         </div>
                        @endif
                      </div>
                   </div>
                </div>
             </div>             
          </div>
          <div class="col-lg-4">
             <div class="blog_right_sidebar">
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

                <aside class="single_sidebar_widget popular_post_widget">
                   <h3 class="widget_title">Eventos</h3>
                   @foreach ($eventos as $item)
                     <div class="media post_item">
                        <img class="rounded"  width="20%" src="{{asset('storage/'.$item->url)}}" alt="post">
                        <div class="media-body">
                        <a href="{{route('web.eventoshow', $item->id)}}">
                              <h3>{{$item->titulo}}</h3>
                           </a>
                           <p><i class="fa fa-clock-o"></i> {{date("d-m -Y", strtotime($item->fecha_realizacion))}}</a></p>
                        </div>
                     </div>
                   @endforeach                   
                </aside> 

             </div>
          </div>
       </div>
    </div>
 </section>
 <!--================ Blog Area end =================-->
    
@endsection

@section('js')

<script>
   $('.btn-pago').click(function(){
      var link = $(this).val();  
      window.open (link);
   });
</script>
<script src="{{asset('frontend/js/ajax-subcripcion.js')}}"></script>
@endsection