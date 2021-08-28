<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['name','itinerario' ,'services','tips','description_tour','description_place','amount','slug','category_id'];

    public function stations()
    {
        return $this->belongsToMany(Station::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
