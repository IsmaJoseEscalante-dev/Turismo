<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','amount','slug'];

    public function stations()
    {
        return $this->hasMany(Station::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
