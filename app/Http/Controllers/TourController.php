<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\Tour\CreateRequest;
use App\Http\Requests\Tour\UpdateRequest;
use App\Models\Category;

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
        $categories = Category::all();
        return view('admin.tours.create',compact('categories'));
    }

    public function store(CreateRequest $request)
    {
        $tour = Tour::create($request->validated());
        $path = $request->file('image')->store('public');

        $image = new Image(['image' => $path]);

        $tour->image()->save($image);
        return redirect()->route('tours.index');
    }

    public function show(Tour $tour)
    {
        return view('admin.tours.show', compact('tour'));
    }

    public function edit(Tour $tour)
    {
        $categories = Category::all();
        return view('admin.tours.edit', compact('tour','categories'));
    }

    public function update(UpdateRequest $request,Tour $tour)
    {
        $tour->update($request->all());

        return redirect()->route('tours.index');
    }

    public function destroy($id)
    {
        $tour = Tour::find($id);
        $tour->delete();
        return redirect()->route('tours.index');
    }
}
