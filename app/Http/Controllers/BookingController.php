<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\StoreRequest;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Promotion;
use App\Models\Tour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{


    public function show($id)
    {
        return view('user.showReservation', [
            'booking' => Booking::where('id', $id)->with(['passengers', 'tour'])->firstOrFail()
        ]);
    }

    public function bookingTour($id)
    {
        $cart = Cart::where('tour_id', $id)->where('user_id',Auth::id())->with('passengers','tour')->firstOrFail();
        return view('user.booking', compact('cart'));
    }
}
