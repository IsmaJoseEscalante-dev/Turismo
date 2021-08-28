<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['start','end','amount','description','title','color','category_id'];

    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
