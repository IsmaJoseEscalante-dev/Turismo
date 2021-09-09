<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Event;
use App\Models\Image;
use App\Models\Station;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $tours = Tour::where('category_id',1)
        ->withAvg('comments as promedio_points','points')->get();

        $events = Tour::where('category_id','>',1)
                ->whereHas('event', function($query){
                    $query->where('start','>',Carbon::now());
                })
                ->withAvg('comments as promedio_points','points')
                ->get();

        $promotions = Promotion::all();

        $stations = Station::inRandomOrder()->take(5)->get();


        return view('welcome', compact('tours','promotions','events','stations'));
    }

    public function paradas($slug)
    {
        $tour = Tour::where('slug',$slug)->firstOrFail();
        $paradas = $tour->stations()->where('tour_id', $tour->id)->with('images')->get();
        return view('user.parada', compact('tour','paradas'));
    }

    public function promotions($slug)
    {
        $promotion = Promotion::where('slug',$slug)
                    ->firstOrFail();
        return view('user.promotion', compact('promotion'));
    }

    public function events($slug)
    {
        $event = Event::where('slug',$slug)
            ->firstOrFail();
        return view('user.event', compact('event'));
    }
    public function booking()
    {
        return view('user.booking');
    }
}
