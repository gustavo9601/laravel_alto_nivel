<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Tabla pivtoe de muchos a muchos Cart con Product
    public function products(){
        // withPivot(['column']) Se especifica los campos adicionales que debe traer de la tabla pivote
        // ya que de lo contraraio solo traeria la relacion los 2 id de las tablas a relacionar
        // return $this->belongsToMany(Product::class)->withPivot('quantity');
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity'); // Un carrito tiene muchos productos

    }


}
