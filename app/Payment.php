<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'payed_at',
        'order_id'
    ];

    // Atributos que deben ser transformados como fechas usando Carbon de laravel
    protected $dates =[
        'payed_at'
    ];

    // Un pago pertenece a una orden
    public function order(){
        return $this->belongsTo(Order::class);
    }

}
