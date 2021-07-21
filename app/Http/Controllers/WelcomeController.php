<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $tours = Tour::all();
        return view('welcome', compact('tours'));
    }

    public function paradas($slug)
    {
        $tour = Tour::where('slug',$slug)->firstOrFail();
        return view('user.parada', compact('tour'));
    }

    public function booking()
    {
        return view('user.booking');
    }
}
