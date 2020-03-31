<?php

namespace App\Http\Controllers;

use App\Suscripcion;
use App\Http\Requests\Subscripcion\SubscripcionRequest;
use Illuminate\Http\Request;

class SuscripcionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $suscripciones = Suscripcion::all(['id','nombre','correo','remember_token']);
        return view('backend.pages.suscripcion.index',compact('suscripciones'));
    }

    public function create()
    {
        $suscripciones = Suscripcion::all();
        return response()->json($suscripciones);
    }

    public function edit($id)
    {
        $suscripcion = Suscripcion::find($id);
        return response()->json($suscripcion);

    }

    public function update(SubscripcionRequest $request, $id)
    {
        
        Suscripcion::updateOrCreate(['id' => $id],['nombre' => $request->nombre, 'correo' => $request->correo]);
        return response()->json("¡Ha ocurrido un error en el sistema.!");
        
    }

    public function destroy($id)
    {
        $suscripcion_a_eliminar = Suscripcion::find($id);
        Suscripcion::destroy($id);
        return response()->json("¡La Suscripcion se elimino exitosamente!");
    }
}
