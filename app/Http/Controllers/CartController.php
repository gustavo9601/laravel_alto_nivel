<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public $cartService;
    // Inyeccion de dependencias, para contar con las funcionalidades de la clase
    // Variable de acceso global que toma la instancia de la inyeccion
    // El contructor recibe El nombre de la Clase y la variable de instancia
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cart = $this->cartService->getFormmCookie();
        // dd($cart->products);
        // Realiza el retorno, de los productos que contenga el carrito
        // Laravel automaticamente llevara la propiedad de products por la relacion existente
        return view('carts.index')
            ->with([
                'cart'=> $cart
            ]);

    }

}
