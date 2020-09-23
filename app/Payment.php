<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'payed_at'
    ];

    // Atributos que deben ser transformados como fechas usando Carbon de laravel
    protected $dates =[
        'payed_at'
    ];

}
