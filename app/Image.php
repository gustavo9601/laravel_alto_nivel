<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'path'
    ];

    // imageable => nombre del metodo
    public function imageable()
    {
        return $this->morphTo();
    }
}
