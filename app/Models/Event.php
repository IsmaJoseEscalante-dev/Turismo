<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['start','end','amount','description','name','slug','color','tour_id'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
