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
    public function index()
    {
        $bookings = Booking::get();
        return view('admin.bookings.index',compact('bookings'));
    }

    public function create()
    {
        $bookings = Booking::get();
        return view('admin.bookings.index',compact('bookings'));
    }

    public function show($id)
    {
        return view('user.showReservation', [
            'booking' => Booking::where('id', $id)->with(['passengers', 'tour'])->firstOrFail()
        ]);
    }

    public function bookingCart($id)
    {
        $cart = Cart::where('user_id',Auth::id())->where('id', $id)->with('passengers')->firstOrFail();
        return view('user.booking', compact('cart'));
    }
}
