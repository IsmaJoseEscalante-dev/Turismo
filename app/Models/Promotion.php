<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'name', 'description', 'amount', 'discount', 'date_start', 'date_finish', 'status'
    ];

    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }

}
