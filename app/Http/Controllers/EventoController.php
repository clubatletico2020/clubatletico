<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Estado;
use Illuminate\Http\Request;
use App\Http\Requests\Evento\EventoRequest;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;

class EventoController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //code...

            $eventos = Evento::all(['id','titulo','url','descripcion','link_pago','fecha_realizacion','lugar_realizacion']);
            $estados = Estado::all(['id','estado']);
            return view('backend.pages.evento.index', compact('eventos','estados'));
        } catch (\Exception $e) {
            //throw $th;
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eventos = Evento::all();
        return response()->json($eventos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventoRequest $request)
    {
        $titulo                     = $request->titulo;
        $url                        = $request->url;
        $descripcion                = $request->descripcion;
        $link_pago                  = $request->link_pago;
        $imagen                     = $request->imagen;
        $fecha_realizacion          = $request->fecha_realizacion;
        $lugar_realizacion          = $request->lugar_realizacion;
        $hora_realizacion           = $request->hora;
        $estado_id                  = $request->estado;
        $_token                     = $request->_token;

        $img = storage::disk('public')->putFile('/evento', new File($imagen));

        if ($request->fecha_realizacion == '' || $request->fecha_realizacion == null) {
           $fecha_realizacion = null;
        }else{
            $fecha_realizacion = date('Y-m-d',strtotime($request->fecha_realizacion))." ".$hora_realizacion;
        }

        DB::beginTransaction();
        try
        {
            /*cuerpo de codigo*/
            $evento                     = new Evento;
            $evento->titulo             = $titulo;
            $evento->url                = $img;
            $evento->descripcion        = $descripcion;
            $evento->link_pago          = $link_pago;
            $evento->fecha_realizacion  = $fecha_realizacion;
            $evento->lugar_realizacion  = $lugar_realizacion;
            $evento->estado_id          = $estado_id;
            $evento->usuario_id         = Auth()->user()->id;
            $evento->remember_token     = $_token;
            $objeto_guardado            = $evento->save();

            DB::commit();
            /*cuerpo de condiciones*/
            if ($objeto_guardado==true) {
                # code...
                return response()->json("¡El Evento se creo exitosamente!");

            } elseif ($objeto_guardado==false) {
                # code...
                return response()->json("¡Ha ocurrido un error en el sistema.!");
            }
        } catch (\Exception $e) {
        DB::rollback();
        return response()->json("¡Ha ocurrido un error en el sistema.!");
        }

    }

    public function show($id)
    {
        $evento = Evento::find($id);

        $hora = explode(" ",$evento->fecha_realizacion);
        $date=date_create($hora[0]);
        $fecha_evento = date_format($date,'d-m-Y');

        return response()->json(array("evento"=>$evento,"hora"=>$hora[1],"fecha_evento"=>$fecha_evento));
    }

    public function edit(Request $request,$id)
    {
        $evento = Evento::find($id);
        $estados = Estado::all(['id','estado']);
        return view('backend.pages.evento.edit', compact( 'evento','estados'));
    }


    public function update(Request $request, Evento $evento)
    {
        $id                         = $request->id_evento;
        $titulo                     = $request->titulo;
        $url                        = $request->url;
        $descripcion                = $request->descripcion;
        $link_pago                  = $request->link_pago;
        $imagen                     = $request->imagen;
        $fecha_realizacion          = $request->fecha_realizacion;
        $lugar_realizacion          = $request->lugar_realizacion;
        $hora_realizacion           = $request->hora;
        $estado_id                  = $request->estado;
        $_token                     = $request->_token;

        
        if ($request->fecha_realizacion == '' || $request->fecha_realizacion == null) {
           $fecha_realizacion = null;
        }else{
            $fecha_realizacion = date('Y-m-d',strtotime($request->fecha_realizacion))." ".$hora_realizacion;
        }


        DB::beginTransaction();
        try
        {
            /*cuerpo de codigo*/
            $evento                     = Evento::find($id);

            if (!empty($imagen)) {
                Storage::disk('public')->delete($evento->url);
                $img = Storage::disk('public')->putFile('/evento', new File($imagen));
                $evento->url       = $img;
            }
            
            $evento->titulo             = $titulo;            
            $evento->descripcion        = $descripcion;
            $evento->link_pago          = $link_pago;
            $evento->fecha_realizacion  = $fecha_realizacion;
            $evento->lugar_realizacion  = $lugar_realizacion;
            $evento->estado_id          = $estado_id;
            $evento->remember_token     = $_token;
            $objeto_guardado            = $evento->save();

            DB::commit();
            /*cuerpo de condiciones*/
            if ($objeto_guardado==true) {
                
                return redirect()->route('evento.index')->with('success', 'Evento actualizado exitosamente. ');

            } elseif ($objeto_guardado==false) {
               
                return redirect()->route('evento.index')->with('error', 'Evento no se actualizado debido a un error. ');
            }

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('evento.index')->with('error', 'Evento no se actualizado debido a un error en el sistema. ');
        }

    }

    public function destroy($id)
    {
        $evento_a_eliminar = Evento::find($id);
        Storage::disk('public')->delete($evento_a_eliminar->url);
        Evento::destroy($id);
        return response()->json("¡El Evento se elimino exitosamente!");
    }
}
