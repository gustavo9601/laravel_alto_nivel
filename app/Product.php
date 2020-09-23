<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'status'
    ];


    // Tabla pivtoe de muchos a muchos Product con Cart
    public function carts(){
        // withPivot(['column']) Se especifica los campos adicionales que debe traer de la tabla pivote
        // ya que de lo contraraio solo traeria la relacion los 2 id de las tablas a relacionar
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }

    // Tabla pivtoe de muchos a muchos Product con Orders
    public function orders(){
        // withPivot(['column']) Se especifica los campos adicionales que debe traer de la tabla pivote
        // ya que de lo contraraio solo traeria la relacion los 2 id de las tablas a relacionar
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }


    // Tabla polimorfica, un producto tiene muchas imagenes
    public function images(){
        // se le especifica el modelo clase, y el nombre del campo morph en la tabla
        return $this->morphMany(Image::class, 'imageable');
    }

}
