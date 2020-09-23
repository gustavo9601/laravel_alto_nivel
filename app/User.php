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
     cast => castea al tipo nativo de PHP n ode carbon
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Atributos que deben ser transformados como fechas usando Carbon de laravel
    protected $dates =[
        'payed_at'
    ];

}
