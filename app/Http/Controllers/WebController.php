<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Subscripcion\SubscripcionRequest;
use App\Slider;
use App\Somos;
use App\Valor;
use App\Evento;
use App\Noticia;
use App\Suscripcion;
use App\Funcionario;

class WebController extends Controller
{
    public function Home()
    {
        $sliders = Slider::where('estado_id', 1)->get();
        $funcionarios = Funcionario::where('tipo_funcionario_id', 1)->get();
        
        if (count(Evento::all()) == '6') {
            $eventos = Evento::all()->random(6);  
         }else{
            $eventos = Evento::all();
         }

         if (count(Noticia::all()) > '6') {
            $noticias = Noticia::all()->random(6);
         }else{
            $noticias = Noticia::all();
         }

        return view('frontend.pages.home', compact('sliders', 'eventos', 'noticias', 'funcionarios'));
    }

    public function Conocenos()
    {   
        $somos = Somos::where('id', 1)->first();
        $valores = Valor::all();
        $funcionarios = Funcionario::where('tipo_funcionario_id', 2)->get();

        return view('frontend.pages.conocenos', compact('somos', 'valores', 'funcionarios'));
    }

    public function Eventos()
    {      
        $eventos = Evento::where('estado_id', 1)->get();
        return view('frontend.pages.evento', compact('eventos'));
    }

    public function ShowEvento($id)
    {
        $evento = Evento::find($id);
        $next       =   Evento::where('id', '>', $evento->id)
                        ->orderBy('id', 'asc')
                        ->first();
        $prev       =   Evento::where('id', '<', $evento->id)
                        ->orderBy('id', 'desc')
                        ->first();

        if (count(Evento::all()) > '3') {
            $eventos = Evento::all()->random(3);
         }else{
            $eventos = Evento::all();
        }
        return view('frontend.pages.evento-show', compact('evento', 'eventos', 'next', 'prev'));
    }

    public function Noticias()
    {      
        $noticias = Noticia::where('estado_id', 1)->get();
        return view('frontend.pages.noticia', compact('noticias'));
    }

    public function ShowNoticia($id)
    {
        $noticia = Noticia::find($id);
        $next       =   Noticia::where('id', '>', $noticia->id)
                        ->orderBy('id', 'asc')
                        ->first();
        $prev       =   Noticia::where('id', '<', $noticia->id)
                        ->orderBy('id', 'desc')
                        ->first();
                        
        if (count(Noticia::all()) > '3') {
            $noticias = Noticia::all()->random(3);
         }else{
            $noticias = Noticia::all();
        }
        return view('frontend.pages.noticia-show', compact('noticia', 'noticias', 'next', 'prev'));
    }

    public function Suscripcion(SubscripcionRequest $request)
    {   
        Suscripcion::create(['nombre' => $request->nombre, 'correo' => $request->correo]);
        return response()->json('¡Ha sido suscrito con exito!');
    }

    public function Contacto()
    {      
        
        return view('frontend.pages.contacto', );
    }
}
