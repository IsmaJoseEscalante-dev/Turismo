<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\User;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Station;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\PaymentPlatform;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $request->user()->authorizeRoles(['user']);

        return view('home')->with([
            'bookings' => Booking::where('user_id', auth()->id())->orderByDesc('date')->get()
        ]);
    }

    public function dashboard()
    {
        $tours = Tour::count();
        $users = User::count();
        $carts = Cart::count();
        $bookings = Booking::count();
        $total = Booking::sum('total');

        $date = Carbon::now();
        $year = [];
        $user = [];
        $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
        $val_months = [];
        for ($i = 1 ; $i<= 12; $i++){
            $val_months[] = User::whereYear('created_at',$date->year)->whereMonth('created_at', '=', $i)->count();
        }

        for ($i = 4; $i > -1; $i--) {
            $year[] = $date->year - $i;
        }
        foreach ($year as $value) {
            $user[] = User::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $value)->count();
        }

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
        return view('dashboard',compact('tours','carts','stations','namesCategory','countTours','namesTour','countStations','users','bookings','total'))->with('year', json_encode($year, JSON_NUMERIC_CHECK))->with('user', json_encode($user, JSON_NUMERIC_CHECK))->with('meses', json_encode($meses, JSON_NUMERIC_CHECK))->with('val_months', json_encode($val_months, JSON_NUMERIC_CHECK));
    }


}
