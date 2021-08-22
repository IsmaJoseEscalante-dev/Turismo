<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['status','user_id','tour_id','total','date'];

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
