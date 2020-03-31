<?php

namespace App\Http\Controllers;

use App\Valor;
use Illuminate\Http\Request;
use DB;

class ValorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }    
 
    public function store(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $valores = array();
            $valores = $request->input('valores');
            $respuesta = 0;

            /*
            |--------------------------------------------------------------------------
            | Reinicia el id incremental de la tabla y Borra todos los registros de la tabla Valores
            |--------------------------------------------------------------------------
            */
            $borrar_registros_tabla_valores = DB::table("valores")->delete();
            $max = DB::table('valores')->max('id') + 1; 
            DB::statement("ALTER TABLE valores AUTO_INCREMENT =  $max");

            /*
            |--------------------------------------------------------------------------
            | Si esta vacio el array, entonces responder con un cero.
            |--------------------------------------------------------------------------
            */
            
            if($valores==null)
            {
                return response()->json($respuesta);
            }
            else
            {
                
                /*cuerpo de codigo*/

                DB::beginTransaction();
                try 
                {
                    
                    
                    /*
                    |--------------------------------------------------------------------------
                    | Declaracion de arrays
                    |--------------------------------------------------------------------------
                    */
                    $ides_registros_creados = array();
                    $array_respuestas = array();
                    $length_valores = sizeof($valores);

                    if ($length_valores>0) 
                    {
                        # code...
                        /*
                        |--------------------------------------------------------------------------
                        | Ciclo for que ingresa los registros de valores en la tabla.
                        |--------------------------------------------------------------------------
                        */
                        for ($i=0; $i < $length_valores; $i++) { 
                            # code...
                            $valor                 = new Valor;
                            $valor->descripcion    = $valores[$i];
                            $valor->remember_token = $request->_token;
                            $objeto_guardado       = $valor->save();
                        
                            DB::commit();
                            /*
                            |--------------------------------------------------------------------------
                            | Si se ingreso correctamente el registro, se guarda su ir de registro en
                            | un array, en caso contrario se notifica de un error 500
                            |--------------------------------------------------------------------------
                            */
                            if ($objeto_guardado==true) {
                                # code...
                                $respuesta = 200;
                                array_push($ides_registros_creados, $valor->id);

                            } elseif ($objeto_guardado==false) {
                                # code...
                                $respuesta = 500;
                            }

                            array_push($array_respuestas, $respuesta);
                        }

                        /*
                        |----------------------------------------------------------------------------------------
                        | Si hubo algun error en las inserciones de registros con codigo 500, entonces borrar todas las 
                        | inserciones que se hicieron en la tabla Valores, en caso contrario devolver a la vista todos los
                        | id  de todos los registros insertados en la tabla Valores.
                        |----------------------------------------------------------------------------------------
                        */

                        if( (in_array(500, $array_respuestas)) || sizeof($ides_registros_creados)==0)
                        {
                            DB::table("valores")
                                    ->whereIn('id',$ides_registros_creados)
                                    ->delete();
                            return response()->json(0);
                        }
                        elseif(in_array(200, $array_respuestas)) 
                        {
                            // return response()->json($ides_registros_creados);
                            return response()->json(1);
                        }
                    }
                    else
                    {
                        /*
                        |----------------------------------------------------------------------------------------
                        | La tabla Valores esta vacia.
                        |----------------------------------------------------------------------------------------
                        */
                        return response()->json(0);
                    }
                    
                    
                } catch (\Exception $e) {
                    //dd($e->getMessage());
                    DB::rollback();
                    // something went wrong 
                    // var_dump(->errorInfo );
                    // print_r(->getMessage()); 
                    //  = ->errorInfo; //dd();
                    DB::table("valores")
                                ->whereIn('id',$ides_registros_creados)
                                ->delete();

                    $respuesta = 600;
                    return response()->json($e->getMessage());
                }

            }
            // $length_valores = count($valores);
            // Valor::create([]);
            // return response()->json(gettype($valores));
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Valor  $valor
     * @return \Illuminate\Http\Response
     */
    public function show(Valor $valor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Valor  $valor
     * @return \Illuminate\Http\Response
     */
    public function edit(Valor $valor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Valor  $valor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Valor $valor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Valor  $valor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Valor $valor)
    {
        //
    }
}
