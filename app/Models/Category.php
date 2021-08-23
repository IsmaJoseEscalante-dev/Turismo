<?php

namespace App\Models;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','slug'];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

}
