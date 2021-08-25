<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Event;
use App\Models\Image;
use App\Models\Station;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $tours = Tour::all();
        $events = Event::all();
        //incluimos la libreria

    /* include "lib_fecha_texto.php";

    //llamamos a la funcion y pasamos como paramentro una fecha
    //con el formato dd/mm/yyyy
    $fecha_texto = fechaATexto("16/04/2015");

    //imprimirmos el resultado
    echo "Fecha a texto: <strong>$fecha_texto</strong>"; */

        return view('welcome', compact('tours','events'));
    }

    public function paradas($slug)
    {
        $tour = Tour::where('slug',$slug)->firstOrFail();
        $paradas = Station::where('tour_id', $tour->id)->with('images')->get();
        return view('user.parada', compact('tour','paradas'));
    }

    public function booking()
    {
        return view('user.booking');
    }
}
