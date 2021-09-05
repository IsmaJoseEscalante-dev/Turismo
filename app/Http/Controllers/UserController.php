<?php

namespace App\Http\Controllers;


use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::get();
        return view('admin.users.show',compact('users'));
    }

    public function updateUser(UpdateRequest $request)
    {
        auth()->user()->update($request->validated());
        return redirect()->route('home')->with('change-user','modificado correctamente');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        auth()->user()->update($request->validated());
        return redirect()->route('home')->with('change-user','modificado correctamente');
    }
}
