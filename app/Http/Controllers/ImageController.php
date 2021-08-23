<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Station;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index($id)
    {
        $images = Image::where('imageable_id',$id)
            ->where('imageable_type','App\\Models\\Station')
            ->get();
        return $images;
    }

    public function storeStation(Request $request,$id)
    {
        $station = Station::findOrFail($id);
        $path = $request->file('image')->store('public');
        $image = new Image(['image' => $path]);
        $station->images()->save($image);
        return;
    }

    public function deleteStation($id)
    {
        $image = Image::findOrFail($id);
        if(Storage::delete($image->image)) {
            $image->delete();
        }
        return;
    }

    public function deleteTour()
    {

    }
}
