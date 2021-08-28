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
        $categories = Category::pluck('name', 'id');
        $tours = Tour::pluck('name', 'id');
        return view('admin.events.index', compact('tours','categories'));
    }
    public function index()
    {
        return Event::with('tours:name,id','category:name,id')->get();
    }

    public function store(CreateRequest $request)
    {
        $event = Event::create($request->validated());
        $event->tours()->sync($request->input('tours', []));
        return;
    }

    public function update(UpdateRequest $request, Event $event)
    {
        $event->update($request->validated());
        $event->tours()->sync($request->input('tours', []));
        return;
    }

    public function destroy(Event $event)
    {
        $event->tours()->detach();
        return $event->delete();
    }
}
