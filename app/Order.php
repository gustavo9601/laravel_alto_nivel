<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'status',
        'customer_id'
    ];

    // Una orden tiene una clase
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Una orden pertecene a un usuario
    // le pasamos el nombre de la clave foranea, si no tiene la consistencia de laravel
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }


    // Tabla pivtoe de muchos a muchos Order con Product
    public function products()
    {
        // withPivot(['column']) Se especifica los campos adicionales que debe traer de la tabla pivote
        // ya que de lo contraraio solo traeria la relacion los 2 id de las tablas a relacionar
        // return $this->belongsToMany(Product::class)->withPivot('quantity');
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity'); // La orden tiene muchos productos
    }


}
