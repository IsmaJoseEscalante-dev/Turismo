<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\StoreRequest;
use App\Models\Cart;
use App\Models\Passenger;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())
                ->where('status','pendiente')
                ->get();
        return view('user.checkout', compact('carts'));
    }

    public function show()
    {
        $carts = Cart::get();
        return view('admin.carts.show',compact('carts'));
    }

    public function store(StoreRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $cart = Cart::create($request->validated());

            for ($i = 0; $i < count($request->input('names')); $i++) {
                Passenger::create([
                    'name' => $request->input('names')[$i]['name'],
                    'lastName' => $request->input('names')[$i]['lastName'],
                    'user_id' => $request->input('user_id'),
                    'cart_id' => $cart->id
                ]);
            }
        });
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return back();
    }
}
