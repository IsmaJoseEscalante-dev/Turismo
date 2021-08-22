<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\StoreRequest;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function store(StoreRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $cart = Cart::create($request->validated());

            for ($i = 0; $i < count($request->input('names')); $i++) {
                $cart->passengers()->create([
                    'name' => $request->input('names')[$i]['name'],
                    'lastName' => $request->input('names')[$i]['lastName'],
                    'user_id' => $request->input('user_id'),
                    'tour_id' => $request->input('tour_id'),
                ]);
            }
        });
    }

    public function show($id)
    {
        return view('user.showReservation', [
            'booking' => Booking::where('id', $id)->with(['passengers', 'tour'])->firstOrFail()
        ]);
    }

    public function bookingTour($id)
    {
        return view('user.booking')->with([
            'cart' => Cart::where('tour_id', $id)->with('passengers','tour')->firstOrFail()
        ]);

    }

}
