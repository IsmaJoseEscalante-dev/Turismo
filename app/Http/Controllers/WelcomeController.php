<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Event;
use App\Models\Image;
use App\Models\Station;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $tours = Tour::all();
        $events = Event::all();
        $promotions = Promotion::all();
        return view('welcome', compact('tours','events','promotions'));
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
