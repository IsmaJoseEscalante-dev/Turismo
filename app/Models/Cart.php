<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['cartable_type','cartable_id','user_id','quantity','status','date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartable()
    {
        return $this->morphTo();
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}
