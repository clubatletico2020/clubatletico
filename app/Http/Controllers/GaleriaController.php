<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Galeria;
use App\Imagen;
use App\Http\Requests\Galeria\GaleriaStore; 

class GaleriaController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $galerias = Galeria::all();
        return view('backend.pages.galeria.index', compact('galerias'));
    }

    public function create()
    {
        $galeria = Galeria::all();
        $result = $galeria->load('imagen');
        return response()->json($result);
    }

    public function store(GaleriaStore $request)
    {   
        $new = Galeria::create(['nombre' => $request->nombre]);
        foreach ($request->imagen as $key => $value) {
           $img = storage::disk('public')->putFile('/galeria', new File($value));
           Imagen::create(['url' => $img, 'galeria_id' => $new->id]);
        }
        return response()->json("Galeria añadida exitosamente");
    }

    public function edit($id)
    {   
        $galeria = Galeria::find($id);
        return view('backend.pages.galeria.edit', compact('galeria'));
    }

    public function update(GaleriaStore $request, $id)
    {
        Galeria::updateOrCreate(['id' => $id],['nombre' => $request->nombre]);
        return response()->json("Nombre actualizado exitosamente");
    }

    public function destroy($id)
    {
        $imagenes = Imagen::where('galeria_id', $id)->get();
        foreach ($imagenes as $value) {
            storage::disk('public')->delete($value->url);
            Imagen::destroy($value->id);
        }
        Galeria::destroy($id);
        return response()->json("Galeria eliminada exitosamente");
    }
}
