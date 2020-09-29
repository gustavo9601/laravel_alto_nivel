<?php

namespace App;

use App\Scopes\AvailableScope;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';

    // Fuerza a retornar la respuesta del Modelo, adicionando la relacion existente
    protected $with = [
      'images'
    ];


    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'status'
    ];

    // Un producto puede pertenecer a un cart o a una orden


    // Tabla pivtoe de muchos a muchos Product con Cart
    public function carts()
    {
        // withPivot(['column']) Se especifica los campos adicionales que debe traer de la tabla pivote
        // ya que de lo contraraio solo traeria la relacion los 2 id de las tablas a relacionar
        // return $this->belongsToMany(Cart::class)->withPivot('quantity');
        return $this->morphedByMany(Cart::class, 'productable')->withPivot('quantity'); // Muchos a nuchos, se pasa el nombre de la columna morph
    }

    // Tabla pivtoe de muchos a muchos Product con Orders
    public function orders()
    {
        // withPivot(['column']) Se especifica los campos adicionales que debe traer de la tabla pivote
        // ya que de lo contraraio solo traeria la relacion los 2 id de las tablas a relacionar
        // return $this->belongsToMany(Order::class)->withPivot('quantity');
        return $this->morphedByMany(Order::class, 'productable')->withPivot('quantity');
    }


    // Tabla polimorfica, un producto tiene muchas imagenes
    public function images()
    {
        // se le especifica el modelo clase, y el nombre del campo morph en la tabla
        return $this->morphMany(Image::class, 'imageable');
    }



    // Local Scope
    // Limitando a solo retornar productos disponibles
    // Al llamar esta funcion quedaria  Product::available();
    public function scopeAvailable($query)
    {
        $query->where('status', '=', 'available');
    }

    // Creando un nuevo atributo temporal al modelo, para acceder desde el modelo
    public function getTotalAttribute()
    {
        return $this->pivot->quantity * $this->price;
    }


    /*
     * Se iniializa al llamar cualquier function de este modelo
     * */
    protected static function booted()
    {
        // Agragdno el global scope, pasando una instancia
        static::addGlobalScope(new AvailableScope);
    }

}
