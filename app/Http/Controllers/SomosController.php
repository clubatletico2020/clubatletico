<?php

namespace App\Http\Controllers;

use App\Somos;
use App\Valor;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
// use App\Itemsomos;
// use App\Tipo_Archivo;
use App\Http\Requests\Somos\SomosRequest;
use Response;

class SomosController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $valores = Valor::All(['id','descripcion',]);
        $somos = Somos::where('id','1')->first();
        return view('backend.pages.somos.index', compact('somos','valores'));
    }

    public function create()
    {
        $img = Somos::where('id','1')->first();
        return response()->json($img);
    }

    public function createDocumento()
    {
        $documento = Somos::where('id','1')->first();
        return response()->json($documento);
    }

    public function store(SomosRequest $request)
    {   
        // busca si el registro unico existe
        $existe = Somos::where('id', '1')->first();
        // llego una imagen desde el formulario?
        if ($request->imagen) {
            // el campo url_fundacion no esta vacia?
            if(!empty($existe->url_fundacion)) {
            Storage::disk('public')->delete($existe->url_fundacion);
            }

            // 
            $img = Storage::disk('public')->putFile('/somos', new File($request->imagen));
            Somos::updateOrCreate(['id' => '1'],['url_fundacion' => $img]);            
        }

        Somos::updateOrCreate(['id' => '1'],['fundacion' => $request->fundacion,'mision' => $request->mision, 'vision' => $request->vision]);                
        return response()->json("Información actualizada exitosamente");
    }

    public function destroy($id)
    {   
        $somos = Somos::find($id);
        Storage::disk('public')->delete($somos->url);
        Somos::updateOrCreate(['id' => '1'],['url' => '']); 
        return response()->json("Imagen eliminada exitosamente.");
    }
}
