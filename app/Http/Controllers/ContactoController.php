<?php

namespace App\Http\Controllers;

use App\Prefijo;
use App\Contacto;
use Illuminate\Http\Request;
use DB;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacto = Contacto::find(1);
        $prefijos = Prefijo::all(['id','nombre']);
        return view('backend.pages.contacto.index', compact( 'contacto','prefijos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registros_contacto = Contacto::all(['id','link_mapa','telefono','celular','correo_contacto','prefijo_id']);
        $contactos = $registros_contacto->load('prefijo');
        return response()->json($contactos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $direccion                  = $request->direccion;
        $link_mapa                  = $request->link_mapa;
        $telefono                   = $request->telefono;
        $celular                    = $request->celular;
        $correo_contacto            = $request->correo_contacto;
        $prefijo_id                 = $request->prefijo_id;
        $_token                     = $request->_token;

        // DB::beginTransaction();
        try
        {
            /*cuerpo de codigo*/
            if ($request->save_code == '1')
            {

               $creado =  Contacto::updateOrCreate(['id' => '1'],
                [
                    'telefono'           => $request->telefono,
                    'celular'            => $request->celular,
                    'correo_contacto'    => strtolower($request->correo_contacto),
                    'prefijo_id'         => $request->prefijo_id,
                    'remember_token'     => $_token
                ]);

                return response()->json("Información de contacto actualizada exitosamente.");
            }
            elseif($request->save_code == '2')
            {
                Contacto::updateOrCreate(['id' => '1'],
                [
                    'direccion'          => ucwords($direccion),
                    'link_mapa'          => $link_mapa,
                ]);
                return response()->json("Información de ubicación actualizada exitosamente.");
            }

            // DB::commit();
        } catch (\Exception $e) {
        // //dd($e->getMessage());
        // DB::rollback();
        // // something went wrong
        // // var_dump(->errorInfo );
        // // print_r(->getMessage());
        // //  = ->errorInfo; //dd();
        // // return response()->json($e->getMessage());
        // // return response()->json(500);
        return response()->json("¡Ha ocurrido un error en el sistema.!");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registros_contacto = Contacto::find($id);
        $contactos = $registros_contacto->load('prefijo');

        return response()->json($contactos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacto $contacto)
    {
        $registros_contacto = Contacto::find($id);
        $contactos = $registros_contacto->load('prefijo');

        return response()->json($contactos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request,$id)
    // {
    //     if($request->ajax())
    //     {
    //         $link_mapa                  = $request->link_mapa;
    //         $telefono                   = $request->telefono;
    //         $celular                    = $request->celular;
    //         $correo_contacto            = $request->correo_contacto;
    //         $prefijo_id                 = $request->prefijo_id;
    //         $_token                     = $request->_token;

    //         DB::beginTransaction();
    //         try
    //         {
    //             /*cuerpo de codigo*/
    //             $contacto                     = Contacto::find($id);
    //             $contacto->link_mapa          = $link_mapa;
    //             $contacto->telefono           = $telefono;
    //             $contacto->celular            = $celular;
    //             $contacto->correo_contacto    = $correo_contacto;
    //             $contacto->prefijo_id         = $prefijo_id;
    //             $contacto->remember_token     = $_token;
    //             $objeto_guardado              = $contacto->save();

    //             DB::commit();
    //             /*cuerpo de condiciones*/
    //             if ($objeto_guardado==true) {
    //                 # code...
    //                 return response()->json("¡El Contacto se edito exitosamente!");

    //             } elseif ($objeto_guardado==false) {
    //                 # code...
    //                 return response()->json("¡Ha ocurrido un error en el sistema.!");
    //             }
    //         } catch (\Exception $e) {
    //         //dd($e->getMessage());
    //         DB::rollback();
    //         // something went wrong
    //         // var_dump(->errorInfo );
    //         // print_r(->getMessage());
    //         //  = ->errorInfo; //dd();
    //         // return response()->json($e->getMessage());
    //         // return response()->json(500);
    //         return response()->json("¡Ha ocurrido un error en el sistema.!");
    //         }
    //     }

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {
        $contacto                     = Contacto::find($id);
        $registro_eliminado = $contacto->delete();
        return response()->json("¡El Evento se elimino exitosamente!");
    }
}
