@extends('layouts/backend')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">Gestión Slider</h5>
          </div>
        </div>
      </div>
    </div> 

    <section class="content">
      <div class="container-fluid">        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Nuevo Slider</h3>
              </div>
	        <form id="formSlider" enctype="multipart/form-data">	
	        	<input type="hidden" name="_token" value="<?php echo csrf_token();?>">                      	
                <div class=" row card-body">
	              	<div class="col col-6 col-lg-8">
		                <div class="form-group">
		                    <input type="file" name="imagen" class="form-control form-control-sm imagen" required="">
		                </div>               		
	              	</div>
	              	<div class="col col-6 col-lg-2">
	              		<div class="form-group">
		                    <select class="form-control form-control-sm" name="estado">
		                    	@foreach($estados as $estado)
		                    		<option value="{{$estado->id}}">{{$estado->estado}}</option>
		                    	@endforeach
		                    </select>
		                </div>
	              	</div>
	              	<div class="col col-12 col-lg-2 ">
	              		<div class="form-group">
		                    <button type="submit" class="btn btn-outline-primary btn-block btn-sm btn-slider"><i class="fa fa-upload"></i> Cargar</button>
		                </div>
	              	</div>
	              	<div class="col-12 text-center">
	              		<hr>
	              		<h6>Imagenes</h6>
	              		<hr>
	              	</div>	              	
                </div>
            </form>

            <div class="card-body">            	
		      <div class="row body-slider">
		       @foreach($sliders as $slider)
			       <div class="col col-12 col-lg-4" align="center">
			        <img src="{{asset('storage/'.$slider->url)}}" class="rounded" width="100%">
			        <div class="row m-2">
				        <div class="col-6 ">
					        <select class="form-control form-control-sm block" onchange="UpdateEstado(this.id, this.value)" id="{{$slider->id}}">
					           @foreach($estados as $estado)
					           	@if($slider->estado_id == $estado->id)
					               <option value="{{$estado->id}}" selected="">{{$estado->estado}}</option>
					            @else
					               <option value="{{$estado->id}}">{{$estado->estado}}</option>
					            @endif
					           @endforeach
					        </select>
				        </div>
				        <div class="col-6">
				         <button class="btn btn-outline-danger btn-block btn-sm" onclick="deleteConfirm(this.id)" id="{{$slider->id}}"><i class="fa fa-trash" ></i></button>
				        </div>
			        </div>
			       </div>
		       @endforeach
		      </div>            	
            </div>
            </div>            
          </div>          
        </div>       
    </section>

  </div>

@include('backend/pages/slider/modal')

@endsection

@section('js')
	<script type="text/javascript" src="{{asset('backend/js/ajax-slider.js')}}"></script>
@endsection