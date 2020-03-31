<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Estado;
use App\Slider;
use App\Http\Requests\Slider\SliderStore;

class SliderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $estados = Estado::get();
        $sliders = Slider::get();
        return view('backend.pages.slider.index', compact('estados', 'sliders'));
    }

    public function create()
    {
        $sliders = Slider::all();
        $estados = Estado::all();
        return response()->json(["sliders" => $sliders, "estados" => $estados]);
    }

    public function store(SliderStore $request)
    {   
        $slider = Storage::disk('public')->putFile('/imagen', new file($request->imagen));
        // Slider::create(['url' => $slider, 'estado_id' => $request->estado, 'remember_token'=>$request->_token ]);
        // return response()->json("Slider añadido exitosamente.");

        $slider_modelo                  = new Slider;
        $slider_modelo->url             = $slider;
        $slider_modelo->estado_id       = $request->estado;
        $slider_modelo->remember_token  = $request->_token;
        $objeto_guardado                = $slider_modelo->save();
        return response()->json("Slider añadido exitosamente.");
    }


    public function update(SliderStore $request, $id)
    {
        Slider::updateOrCreate(['id' => $id], ['estado_id' => $request->estado]);
        return response()->json("Estado de slider actualiazado.");
    }


    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->url);
        Slider::destroy($slider->id);
        return response()->json('Slider ha sido eliminado exitosamente.');
    }
}
