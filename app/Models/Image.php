<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['image','imageable_type','imageable_id'];

    #https://www.laraveltip.com/como-mostrar-imagenes-de-la-carpeta-storage-en-laravel/

    public function imageable()
    {
        return $this->morphTo();
    }
}
