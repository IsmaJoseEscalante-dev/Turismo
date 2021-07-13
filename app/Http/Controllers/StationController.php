<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Image;
use App\Models\Station;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {

        $nameTour = Tour::where('id', $id)->first();
        $stations = Station::where('tour_id', $id)->get();

        return view('admin.station.index', compact('stations', 'nameTour'));
    }

    public function create($id)
    {
        $tour = Tour::where('id', $id)->first();
        return view('admin.station.create', compact('tour'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = time().$file->getClientOriginalName();
            $file->move(public_path().'/image',$path);
        }
        $image = new Image(['image' => $path]);
        $station = Station::create($request->all());
        $station->images()->save($image);
        return redirect()->route('station.index', $station->tour_id);
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

    public function update(Request $request, $id)
    {
        $station  = Station::find($id);

        $station->name        = $request->get('name');
        $station->description = $request->get('description');
        $station->save();

        return redirect()->route('station.index', $station->tour_id);
    }

    public function destroy(Station $station)
    {
        $station->delete();
        return redirect()->route('station.index', $station->tour_id);
    }
}
