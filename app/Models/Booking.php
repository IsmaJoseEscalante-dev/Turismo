<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['title','user_id','cart_id','type_booking','total','date'];

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
