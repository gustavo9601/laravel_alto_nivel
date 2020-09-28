<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin_since'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * cast => castea al tipo nativo de PHP n ode carbon
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Atributos que deben ser transformados como fechas usando Carbon de laravel
    protected $dates = [
        'admin_since'
    ];

    // Un usuario tiene muchas ordenes
    // le pasamos el nombre de la clave foranea, si no tiene la consistencia de laravel
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }


    // Relacion a travez de otra relacion
    public function payments()
    {
        // Accede a la tabla, a travez de otra
        // hasManyThrough(Relacion directa con esta clase, Relacion a travez de la otra relacion a acceder, 'indice de relacion que conoce este modelo');
        return $this->hasManyThrough(Payment::class, Order::class, 'customer_id');
    }


    // Un usuario tiene una imagen
    // Usamos una relacion polimorfica
    public function image()
    {
        // Modelo polimofico, campo tipo de la relacion
        return $this->morphOne(Image::class, 'imageable');
    }


    // Funccion accesora o get
    public function isAdmin()
    {
        // admin_since => campo en bd de tipo fecha o null
        // si existe el valor y es menor o igual a la fecha actual returnara true
        // al colorcar a admin_since dentro del arreglo $dates del modelo, este sera tranfirnadi a una instancia de carbon y podra acceder a todas sus funciones
        // ->lessThanOrEqualTo(fecha_de_carbon) Funcion de carbon que verifica si la fecha es menor o igual a la pasada por parametro
        return $this->admin_since !== null && $this->admin_since->lessThanOrEqualTo(now());
    }
}
