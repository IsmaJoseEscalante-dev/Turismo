<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = ['name','lastName','user_id','cart_id'];

    public function carts()
    {
        return $this->morphMany(Cart::class, 'cartable');
    }
}
