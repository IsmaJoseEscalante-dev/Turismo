<?php

namespace App\Http\Controllers;


use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::get();
        return view('admin.users.index',compact('users'));
    }

    public function updateUser(UpdateRequest $request)
    {
        auth()->user()->update($request->validated());
        if(auth()->user()->hasRole('admin')){
            return redirect()->route('dashboard');
        }
        return redirect()->route('home')->with('change-user','modificado correctamente');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        auth()->user()->update($request->validated());
        if(auth()->user()->hasRole('admin')){
            return redirect()->route('dashboard');
        }
        return redirect()->route('home')->with('change-user','modificado correctamente');
    }

    public function showCart(User $user)
    {
        $carts = $user->carts()->get();
        return view('admin.users.showCarro', compact('carts'));
    }

    public function showBooking(User $user)
    {
        $bookings = $user->bookings()->get();
        return view('admin.users.showReservation',compact('bookings'));

    }

    public function editDataAdmin()
    {
        return view('admin.edit');
    }
}
