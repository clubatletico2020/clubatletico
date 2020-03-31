<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Galeria\GaleriaStore; 
use App\Imagen;

class ImagenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {   $imagenes = Imagen::where('galeria_id', $id)->get();
        return response()->json($imagenes);
    }
    
    public function store(GaleriaStore $request)
    {
        foreach ($request->imagen as $key => $value) {
            $img = storage::disk('public')->putFile('/galeria', new File($value));
            Imagen::create(['url' => $img, 'galeria_id' => $request->id]);
        }
        return response()->json("Imagenes cargadas exitosamente");   
    }

    public function destroy(Imagen $imagen)
    {   
        $cantidad = count(Imagen::where('galeria_id', $imagen->galeria_id)->get());
        if ($cantidad != '1') {
            Storage::disk('public')->delete($imagen->url);
            Imagen::destroy($imagen->id);
            return response()->json("Imagen eliminada exitosamente");  
        }else{
            return response()->json(['errors' => ['message' =>  'La galeria no puede quedar sin imagenes.']], 422);
        }        
    }
}
