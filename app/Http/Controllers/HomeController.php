<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\User;
use App\Models\Booking;
use App\Models\Station;
use App\Models\Category;
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
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);
        return view('home')->with([
            'bookings' => Booking::where('user_id', auth()->id())->orderByDesc('date')->get()
        ]);
    }

    public function dashboard()
    {
        $tours = Tour::count();
        $users = User::count();

        $datosTS = Tour::select(['name'])
        ->withCount('stations')
        ->get();

        $datosTC = Category::select(['name'])
        ->withCount('tours')
        ->get();

        $stations = Station::count();

        $namesTour = array();
        $countStations = array();
        foreach ($datosTS  as $dato) {
            array_push($namesTour , $dato->name);
            array_push($countStations  , $dato->stations_count);
        }

        $namesCategory = array();
        $countTours = array();
        foreach ($datosTC as $dato) {
            array_push($namesCategory , $dato->name);
            array_push($countTours , $dato->tours_count);
        }
        /* print_r($values);
        print_r( $names);
        var_dump($tours); */
        return view('dashboard',compact('tours','stations','namesCategory','countTours','namesTour','countStations','users'));
    }
}
