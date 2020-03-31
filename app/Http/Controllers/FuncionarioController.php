<?php

namespace App\Http\Controllers;

use App\Funcionario;
use App\TipoFuncionario;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionarios = Funcionario::all();
        // dd($funcionarios->load('tipo_funcionario')->toArray());
        $tipos_funcionarios = TipoFuncionario::all();
        return view('backend.pages.funcionarios.index',compact('funcionarios','tipos_funcionarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $funcionarios = Funcionario::all();
        $result = $funcionarios->load('tipo_funcionario');
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax())
        {
                $imagen                     = "no_imagen.jpg";
                $imagen_formulario          = $request->imagen;
            try
            {
                // dd($request->all());
                $funcionario                        = new Funcionario;
                $funcionario->nombre                = $request->nombre;
                $funcionario->url                   = $imagen;
                $funcionario->cargo                 = $request->cargo;
                $funcionario->tipo_funcionario_id   = $request->tipo_funcionario;
                $objeto_guardado                    = $funcionario->save();

                if($objeto_guardado==true)
                {
                    if($imagen_formulario)
                    {
                        # code...
                        $imagen_actualizar = Storage::disk('public')->putFile('/funcionario', new File($imagen_formulario));

                        $imagen_funcionario_actualizada      = Funcionario::find($funcionario->id);
                        $imagen_funcionario_actualizada->url = $imagen_actualizar;
                        $imagen_funcionario_save             = $imagen_funcionario_actualizada->save();
                    }
                    return response()->json("¡El Funcionario se creo exitosamente!");
                }
                elseif($objeto_guardado==false)
                {
                    # code...
                    return response()->json("¡El Funcionario no se guardo ya que ha ocurrido un error en el sistema.!");
                }
                DB::commit();
            }
            catch (Exception $e)
            {
                //dd($e->getMessage());
                DB::rollback();
                // something went wrong
                // var_dump(e->errorInfo );
                // print_r($e->getMessage());
                // error = ->errorInfo; //dd();
                // return response()->json($e->errorInfo);
                return response()->json("¡Ha ocurrido un error en el sistema, contactese con el Administrador.!");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $funcionario = Funcionario::find($id);
        $result = $funcionario->load('tipo_funcionario');
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $funcionario = Funcionario::find($id);
        $tipos_funcionarios = TipoFuncionario::all();
        $result = $funcionario->load('tipo_funcionario');
        return response()->json(["funcionario"=>$result,"tipo_funcionarios"=>$tipos_funcionarios]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcionario $funcionario)
    {

        try
        {
            // dd($request->all());
            $id                                 = $request->id;
            $funcionario                        =  Funcionario::find($id);
            $funcionario->nombre                = $request->nombre;
            $funcionario->cargo                 = $request->cargo;
            $funcionario->tipo_funcionario_id   = $request->tipo_funcionario;
            $objeto_guardado                    = $funcionario->save();

            if($objeto_guardado==true)
            {
                // inicio actualizacion de la imagen
                $imagen_formulario = $request->imagen;
                $imagen_funcionario_actualizada  = Funcionario::find($id);

                // Revisa en el campo url del registro de la tabla Noticias
                // y despues captura el nombre de la imagen y verifica si existe
                // la imagen en el directorio public/noticia.
                // solo se editara si existe la imagen en la carpeta public/noticia

                // Solo si viene una imagen en el formulario,revisar en el campo sql de noticias y revisar en el
                // disco public/noticias para borrar y actualizar
                if($imagen_formulario)
                {
                    // Existe en nombre de la imagen en la tabla Noticias
                    if ($imagen_funcionario_actualizada->url) {
                        //  Eliminar y actualiza la imagen  existe o no en el disco public/noticia
                        if (Storage::disk('public')->exists($imagen_funcionario_actualizada->url)) {
                            # code...
                            //Eliminamos la imagen de la carpeta public/noticia
                            storage::disk('public')->delete($imagen_funcionario_actualizada->url);
                        }

                        //Creamos la imagen en el disco local public/noticia
                        $imagen_actualizar =Storage::disk('public')->putFile('/funcionario', new File($imagen_formulario));
                        // y se actualiza
                        $imagen_funcionario_actualizada->url = $imagen_actualizar;
                    }
                }


                $imagen_funcionario_actualizada->save();
                return response()->json("¡El Funcionario se actualizo exitosamente!");

                // fin de la actualizacion de la imagen
            }
            elseif($objeto_guardado==false)
            {
                # code...
                return response()->json("¡El Funcionario no se actualizo debido que ha ocurrido un error en el sistema.!");
            }
            DB::commit();
        }
        catch (Exception $e)
        {
            //dd($e->getMessage());
            DB::rollback();
            // something went wrong
            // var_dump(e->errorInfo );
            // print_r($e->getMessage());
            // error = ->errorInfo; //dd();
            // return redirect()->route('listado.paciente')->with('error_insercion','Se produjo una excepción al guardar el registro');
            return response()->json("¡Ha ocurrido una excepcion en el sistema.!");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $funcionario_a_eliminar = Funcionario::find($id);
            Storage::disk('public')->delete($funcionario_a_eliminar->url);

            // Validando que la imagen exista
            if (Storage::disk('public')->exists($funcionario_a_eliminar->url)) {
                # code...
                //Eliminamos la imagen de la carpeta public/noticia
                Storage::disk('public')->delete($funcionario_a_eliminar->url);
            }

            $funcionario_eliminado = $funcionario_a_eliminar->delete();

            if($funcionario_eliminado==true)
            {
                # code...
                return response()->json("¡El Funcionario se elimino exitosamente!");
            }
            elseif($funcionario_eliminado==false)
            {
                # code...
                return response()->json("¡El Funcionario no se eliminar debido que ha ocurrido un error en el sistema.!");
            }
            DB::commit();
        }
        catch (Exception $e)
        {
            //dd($e->getMessage());
            DB::rollback();
            // something went wrong
            // var_dump(e->errorInfo );
            // print_r($e->getMessage());
            // error = ->errorInfo; //dd();
            return response()->json("¡Ha ocurrido una excepcion en el sistema.!");
        }
    }
}
