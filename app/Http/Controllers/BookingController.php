<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\StoreRequest;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Passenger;
use App\Models\PaymentPlatform;
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

    public function edit()
    {
        $bookings = Booking::get();
        return view('admin.bookings.index',compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::where('id',$id)->firstOrFail();
        $cart = Cart::where('id', $booking->cart_id)->firstOrFail();
        $passengers = Passenger::where('cart_id', $cart->id)->get();
        return view('user.showReservation',compact('booking','cart','passengers'));
    }

    public function bookingCart($id)
    {
        $cart = Cart::where('user_id',Auth::id())->where('id', $id)->with('passengers')->firstOrFail();

        $paymentPlatforms = PaymentPlatform::all();
        return view('user.booking', compact('cart','paymentPlatforms'));
    }
}
