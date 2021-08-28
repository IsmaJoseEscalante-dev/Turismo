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

    public function index()
    {

        $stations = Station::get();

        return view('admin.stations.index', compact('stations'));
    }

    public function create()
    {
        return view('admin.stations.create');
    }

    public function store(CreateRequest $request)
    {
        $station = Station::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('stations.edit', $station->id);
    }

    public function show(Station $station)
    {
        return view('admin.stations.show', compact('station'));
    }

    public function edit($id)
    {
        $station = Station::find($id);
        return view('admin.stations.edit')->with('station', $station);
    }

    public function update(UpdateRequest $request, Station $station)
    {
        $station->update($request->validated());
        return redirect()->route('stations.index', $station->tour_id);
    }

    public function destroy(Station $station)
    {
        $station->delete();
        return redirect()->route('stations.index', $station->tour_id);
    }
}
