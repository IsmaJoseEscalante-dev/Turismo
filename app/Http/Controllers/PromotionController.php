<?php

namespace App\Http\Controllers;

use App\Http\Requests\Promotion\CreateRequest;
use App\Http\Requests\Promotion\UpdateRequest;
use App\Models\Tour;
use App\Models\Image;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $tours = Tour::pluck('name','id');
        return view('admin.promotions.create',compact('tours'));
    }

    public function store(CreateRequest $request)
    {
        $promotion = Promotion::create($request->validated());

        $path = $request->file('image')->store('public');

        $image = new Image(['image' => $path]);

        $promotion->image()->save($image);
        $promotion->tours()->attach($request->tours);
        return redirect()->route('promotions.index');
    }

    public function show(Promotion $promotion)
    {
        return view('admin.promotions.show', compact('promotion'));
    }

    public function edit(Promotion $promotion)
    {
        $tours = Tour::pluck('name','id');
        return view('admin.promotions.edit', compact('promotion','tours'));
    }

    public function update(UpdateRequest $request, Promotion $promotion)
    {
        $promotion->update($request->validated());
        if($request->hasFile('image')){
            $image = $promotion->image;
            $image->image = $request->file('image')->store('public');
            $image->save();
        }
        $promotion->tours()->sync($request->tours);
        return redirect()->route('promotions.index');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return back();
    }
}
