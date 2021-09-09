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
        $userYear = [];
        $bookingYear = [];
        $bookingsMonth = [];
        $userMonth = [];
        $montoYear = [];
        $montoMonth = [];
        $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

        // user created for month
        for ($i = 1 ; $i<= 12; $i++){
            $userMonth[] = User::whereYear('created_at',$date->year)->whereMonth('created_at', '=', $i)->count();
        }
        // bookings created for month
        for ($i = 1 ; $i<= 12; $i++){
            $bookingsMonth[] = Booking::whereYear('created_at',$date->year)->whereMonth('created_at', '=', $i)->count();
        }
        // bookings created for month
        for ($i = 1 ; $i<= 12; $i++){
            $montoMonth[] = Booking::whereYear('created_at',$date->year)->whereMonth('created_at', '=', $i)->sum('total');
        }
        // loading the last 5 years
        for ($i = 4; $i > -1; $i--) {
            $year[] = $date->year - $i;
        }
        // user created for year
        foreach ($year as $value) {
            $userYear[] = User::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $value)->count();
        }
        // booking created for year
        foreach ($year as $value) {
            $bookingYear[] = Booking::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $value)->count();
        }
        // booking created for year
        foreach ($year as $value) {
            $montoYear[] = Booking::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $value)->sum('total');
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
        return view('dashboard',compact('tours','carts','stations','namesCategory','countTours','namesTour','countStations','users','bookings','total'))->with('year', json_encode($year, JSON_NUMERIC_CHECK))->with('userYear', json_encode($userYear, JSON_NUMERIC_CHECK))->with('meses', json_encode($meses, JSON_NUMERIC_CHECK))->with('userMonth', json_encode($userMonth, JSON_NUMERIC_CHECK))->with('bookingYear', json_encode($bookingYear,JSON_NUMERIC_CHECK))->with('bookingsMonth', json_encode($bookingsMonth,JSON_NUMERIC_CHECK))->with('montoYear', json_encode($montoYear,JSON_NUMERIC_CHECK))->with('montoMonth', json_encode($montoMonth,JSON_NUMERIC_CHECK));
    }


}
