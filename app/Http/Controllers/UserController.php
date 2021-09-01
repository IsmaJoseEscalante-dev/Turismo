<?php

namespace App\Http\Controllers;


use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UpdatePasswordRequest;

class UserController extends Controller
{
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
