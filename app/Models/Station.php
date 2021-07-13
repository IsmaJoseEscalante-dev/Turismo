<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description','tour_id'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
