<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Tour;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        $tours = Tour::count();

        $datos = Tour::select(['name'])
        ->withCount('stations')
        ->get();
        $stations = Station::count();
        $names = array();
        $values = array();
        foreach ($datos as $dato) {
            array_push($names , $dato->name);
            array_push($values , $dato->stations_count);
        }
        print_r($values);
        print_r( $names);
        var_dump($tours);
        return view('dashboard',compact('tours','stations','names','values'));
    }

    public function pagar()
    {
        return view('pagar');
    }
}
