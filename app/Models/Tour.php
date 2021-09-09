<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'itinerario', 'services', 'tips', 'description_tour', 'description_place', 'amount', 'slug', 'category_id'];

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

    public function event()
    {
        return $this->hasOne(Event::class);
    }

    public function carts()
    {
        return $this->morphMany(Cart::class, 'cartable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
