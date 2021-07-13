<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\Tour\CreateRequest;
use App\Http\Requests\Tour\UpdateRequest;

class TourController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.tours.index',[
            'tours' => Tour::all()
        ]);
    }

    public function create()
    {
        return view('admin.tours.create');
    }

    public function store(CreateRequest $request)
    {
        Tour::create($request->validated());
        return redirect()->route('tours.index');
    }

    public function show(Tour $tour)
    {
        return view('admin.tours.show', compact('tour'));
    }

    public function edit(Tour $tour)
    {
        return view('admin.tours.edit', compact('tour'));
    }

    public function update(UpdateRequest $request,Tour $tour)
    {
        $tour->update($request->validated);

        return redirect()->route('tours.index');
    }

    public function destroy($id)
    {
        $tour = Tour::find($id);
        $tour->delete();
        return redirect()->route('tours.index');
    }
}
