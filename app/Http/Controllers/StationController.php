<?php

namespace App\Http\Controllers;

use App\Http\Requests\Station\CreateRequest;
use App\Http\Requests\Station\UpdateRequest;
use App\Models\Tour;
use App\Models\Station;

class StationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {

        $nameTour = Tour::where('id', $id)->first();
        $stations = Station::where('tour_id', $id)->with('images')->get();

        return view('admin.station.index', compact('stations', 'nameTour'));
    }

    public function create($id)
    {
        $tour = Tour::where('id', $id)->firstOrFail();
        return view('admin.station.create', compact('tour'));
    }

    public function store(CreateRequest $request)
    {
        $station = Station::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'tour_id' => $request->input('tour_id'),
        ]);
        return redirect()->route('station.edit', $station->id);
    }

    public function show(Station $station)
    {
        return view('admin.station.show', compact('station'));
    }

    public function edit($id)
    {
        $station = Station::find($id);
        return view('admin.station.edit')->with('station', $station);
    }

    public function update(UpdateRequest $request, Station $station)
    {
        $station->update($request->validated());
        return redirect()->route('station.index', $station->tour_id);
    }

    public function destroy(Station $station)
    {
        $station->delete();
        return redirect()->route('station.index', $station->tour_id);
    }
}
