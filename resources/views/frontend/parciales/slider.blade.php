    <div class="slider_area">
        <div class="slider_active owl-carousel">
            @foreach ($sliders as $slider)
                <div class="single_slider  d-flex align-items-center">                    
                    <img src="{{asset('storage/'.$slider->url)}}" alt="">                
                </div>    
            @endforeach                        
        </div>
    </div>