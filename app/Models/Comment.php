<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable =['name','email','points','body','read','status','tour_id'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
