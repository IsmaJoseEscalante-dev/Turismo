<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\CreateRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Models\Event;
use App\Models\Tour;
use App\Models\Category;
class EventController extends Controller
{
    public function events()
    {
        $tours = Tour::where('category_id','!=',1)->pluck('name','id');
        return view('admin.events.index', compact('tours'));
    }
    public function index()
    {
        return Event::with('tour:name,id')->get();
    }

    public function store(CreateRequest $request)
    {
        return Event::create($request->validated());
    }

    public function update(UpdateRequest $request, Event $event)
    {
        return $event->update($request->validated());
    }

    public function destroy(Event $event)
    {
        return $event->delete();
    }
}
