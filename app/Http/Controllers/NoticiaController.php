<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Noticia;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;

class NoticiaController extends Controller
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
        $noticias = Noticia::all();
        // dd($noticias->find(3)->user);
        // Con el metodo load se evita hacer join con QueryBuilder
        // dd($noticias->load('estado', 'user')->toArray());
        $estados = Estado::all(['id','estado']);
        return view('backend.pages.noticias.index', compact( 'noticias','estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $noticia = Noticia::all();
        $result = $noticia->load('estado', 'user');
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
            $titulo                     = $request->titulo;
            $estado_id                  = $request->estado;
            $imagen                     = "no_imagen.jpg";
            $usuario_id                 =  Auth()->user()->id;
            $descripcion                = $request->descripcion;
            $fecha_noticia              = $request->fecha_noticia;
            $_token                     = $request->_token;

            if ($request->fecha_noticia == '' || $request->fecha_noticia == null) {
            $fecha_noticia = null;
            }else{
                $fecha_noticia = date('Y-m-d',strtotime($request->fecha_noticia));
            }

            DB::beginTransaction();
            try
            {
                /*cuerpo de codigo*/
                $noticia                     = new Noticia;
                $noticia->titulo             = $titulo;
                $noticia->descripcion        = $descripcion;
                $noticia->url                = $imagen;
                $noticia->estado_id          = $estado_id;
                $noticia->usuario_id         = $usuario_id;
                $noticia->fecha_noticia      = $fecha_noticia;
                $noticia->remember_token     = $_token;
                $objeto_guardado             = $noticia->save();

                DB::commit();
                /*cuerpo de condiciones*/
                if ($objeto_guardado==true) {
                    # code...
                    $imagen_actualizar =Storage::disk('public')->putFile('/noticia', new File($request->imagen));

                    $imagen_noticia_actualizada  = Noticia::find($noticia->id);
                    $imagen_noticia_actualizada->url = $imagen_actualizar;
                    $imagen_noticia_actualizada->save();
                    return response()->json("¡La Noticia se creo exitosamente!");

                } elseif ($objeto_guardado==false) {
                    # code...
                    return response()->json("¡Ha ocurrido un error en el sistema.!");
                }
            } catch (\Exception $e) {
            //dd($e->getMessage());
            DB::rollback();
            // something went wrong
            // var_dump(->errorInfo );
            // print_r(->getMessage());
            //  = ->errorInfo; //dd();
            return response()->json($e->getMessage());
            // return response()->json(500);
            // return response()->json("¡Ha ocurrido un error en el sistema.!");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noticia = Noticia::find($id);
        $estados = Estado::all();
        $result = $noticia->load('estado', 'user');
        return response()->json(['noticia' => $result, 'estados' => $estados]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noticia = Noticia::find($id);
        $estados = Estado::all();
        $result = $noticia->load('estado', 'user');
        return response()->json(['noticia' => $result, 'estados' => $estados]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax())
        {

            $titulo                     = $request->titulo;
            $estado_id                  = $request->estado;
            $usuario_id                 =  Auth()->user()->id;
            $descripcion                = $request->descripcion;
            $fecha_noticia              = $request->fecha_noticia_editar;
            $_token                     = $request->_token;

            if ($request->fecha_noticia == '' || $request->fecha_noticia == null) {
            $fecha_noticia = null;
            }else{
                $fecha_noticia = date('Y-m-d',strtotime($request->fecha_noticia));
            }

            DB::beginTransaction();
            try
            {
                /*cuerpo de codigo*/
                $noticia                     = Noticia::find($id);
                $noticia->titulo             = $titulo;
                $noticia->descripcion        = $descripcion;
                $noticia->estado_id          = $estado_id;
                $noticia->usuario_id         = $usuario_id;
                $noticia->fecha_noticia      = $fecha_noticia;
                $noticia->remember_token     = $_token;
                $objeto_guardado             = $noticia->save();

                DB::commit();
                /*Valida si el registro se creo en la tabla SQL*/
                if ($objeto_guardado==true) {
                    # code...
                    $imagen_formulario = $request->imagen;


                    $imagen_noticia_actualizada  = Noticia::find($noticia->id);

                    // Revisa en el campo url del registro de la tabla Noticias
                    // y despues captura el nombre de la imagen y verifica si existe
                    // la imagen en el directorio public/noticia.
                    // solo se editara si existe la imagen en la carpeta public/noticia

                    // Solo si viene una imagen en el formulario,revisar en el campo sql de noticias y revisar en el
                    // disco public/noticias para borrar y actualizar
                    if($imagen_formulario)
                    {
                        // Existe en nombre de la imagen en la tabla Noticias
                        if ($imagen_noticia_actualizada->url) {
                            //  Eliminar y actualiza la imagen  existe o no en el disco public/noticia
                            if (Storage::disk('public')->exists($imagen_noticia_actualizada->url)) {
                                # code...
                                //Eliminamos la imagen de la carpeta public/noticia
                                storage::disk('public')->delete($imagen_noticia_actualizada->url);
                            }

                            //Creamos la imagen en el disco local public/noticia
                            $imagen_actualizar =Storage::disk('public')->putFile('/noticia', new File($imagen_formulario));
                            // y se actualiza
                            $imagen_noticia_actualizada->url = $imagen_actualizar;
                        }
                    }


                    $imagen_noticia_actualizada->save();
                    return response()->json("¡La Noticia se actualizo exitosamente!");

                } elseif ($objeto_guardado==false) {
                    # code...
                    return response()->json("¡Ha ocurrido un error en el sistema.!");
                }
            } catch (\Exception $e) {
            //dd($e->getMessage());
            DB::rollback();
            // something went wrong
            // var_dump(->errorInfo );
            // print_r(->getMessage());
            //  = ->errorInfo; //dd();
            // return response()->json($e->getMessage());
            // return response()->json(500);
            return response()->json("¡Ha ocurrido una excepcion en el sistema.!");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia_a_eliminar = Noticia::find($id);
        Storage::disk('public')->delete($noticia_a_eliminar->url);
        Noticia::destroy($id);
        return response()->json("¡La Noticia se elimino exitosamente!");
    }
}
