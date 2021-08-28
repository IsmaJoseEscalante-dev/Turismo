<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Tour\CreateRequest;
use App\Http\Requests\Tour\UpdateRequest;
use App\Models\Station;

class TourController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.tours.index',[
            'tours' => Tour::with('image')->get(),
        ]);
    }

    public function create()
    {
        $categories = Category::pluck('name','id');
        $stations = Station::pluck('name','id');
        return view('admin.tours.create', compact('stations','categories'));
    }

    public function store(CreateRequest $request)
    {
        $tour = Tour::create($request->validated());

        $path = $request->file('image')->store('public');

        $image = new Image(['image' => $path]);

        $tour->image()->save($image);
        $tour->stations()->attach($request->stations);
        return redirect()->route('tours.index');
    }

    public function show(Tour $tour)
    {
        $categories = Category::all();
        $stations = Station::all();
        return view('admin.tours.show', compact('tour','categories'));
    }

    public function edit(Tour $tour)
    {
        $categories = Category::pluck('name','id');
        $stations = Station::pluck('name','id');
        return view('admin.tours.edit', compact('tour', 'stations','categories'));
    }

    public function update(UpdateRequest $request,Tour $tour)
    {
        $tour->update($request->validated());
        if($request->hasFile('image')){
            $image = $tour->image;
            $image->image = $request->file('image')->store('public');
            $image->save();
        }
        $tour->stations()->sync($request->stations);
        return redirect()->route('tours.index');
    }

    public function destroy($id)
    {
        $tour = Tour::find($id);
        $tour->delete();
        return redirect()->route('tours.index');
    }
}
