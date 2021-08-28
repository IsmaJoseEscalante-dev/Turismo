<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Image;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Requests\Promotion\CreateRequest;
use App\Http\Requests\Promotion\UpdateRequest;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::get();
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tours = Tour::get();
        return view('admin.promotions.create',compact('tours'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $promotion = Promotion::create($request->validated());

        $path = $request->file('image')->store('public');

        $image = new Image(['image' => $path]);

        $promotion->image()->save($image);
        $promotion->tours()->attach($request->tours);
        return redirect()->route('promotions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, promotion $promotion)
    {
        $promotion->update($request->validated());
        $promotion->tours()->sync($request->input('tours', []));
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(promotion $promotion)
    {
        //
    }
}
