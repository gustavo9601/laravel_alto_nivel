<?php

namespace App\Services;

use App\Cart;
use Illuminate\Support\Facades\Cookie;

class CartService
{

    protected $cookieName;
    protected $cookieTimeExpiration;

    public function __construct()
    {
        // Asignando valores desde nuestro arhivo de configuracion personalizado
        $this->cookieName = config('cart.cookie.name');
        $this->cookieTimeExpiration = config('cart.cookie.time_expiration');;
    }

    public function getFormmCookie()
    {
        // Capturando una cookie del carrito, sin embargo si no existe retorna null
        // get('name_cookie');
        $cartId = Cookie::get($this->cookieName);

        // Veriicando si existe ese id como un carrito
        $cart = Cart::find($cartId);

        // Devuelve el carritom exista o no
        return $cart;
    }


    public function getFromCookieOrCreate()
    {
        $cart = $this->getFormmCookie();

        // De existir el carrito lo retorna, en caso contrario crea uno nuevo
        return $cart ?? Cart::create();
    }

    public function makeCookie($cart)
    {
        // Crea o repisa la cooquie existen con el id del carrito actual,
        // make('name_cookie', value, time_in_minutes)

        return Cookie::make($this->cookieName, $cart->id, 7 * 24 * 60);
    }


    public function countProducts()
    {
        $cart = $this->getFormmCookie();

        if ($cart != null) {
            return $cart->products
                    ->pluck('pivot.quantity')   // Permite usar unicamente la columna especificada y retornarla
                    ->sum(); // Suma los valores de la coleccion
        }
        return 0;

    }

}
