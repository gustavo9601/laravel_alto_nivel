<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;


class ProductCartController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        // Consulta si existe la coocki, en caso contrario la crea
        $cart = $this->cartService->getFromCookieOrCreate();

        $quantity = $cart->products()
                ->find($product->id) // Filtra el carrito si tine en la lista de products el id pasado por parametro
                ->pivot   // Consulta en la tabla pivote
                ->quantity ?? 0;  // Si retorna null devuelve un 0 en acso contrario devuelve el valor encontrado


        // Añade al carrito y asocia el id del producto enviado , adicinal de pasarle el quantity
        // Independiente si el carrito ya exista o no por bd lo que realizara sera pusehar nuevos productos a ese id generado

        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity' => $quantity + 1]  // le suma en cantidad +1
        ]);

        // Crea o repisa la cooquie existen con el id del carrito actual,
        $cookie = $this->cartService->makeCookie($cart);

        return redirect()->back()
            ->with(['message' => 'Product add correctyly to cart # ' . $cart->id])
            ->cookie($cookie);   // Enviamos la cookie para que se almacene en el navegador, y cifra el valor de la cookie

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @param \App\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @param \App\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @param \App\Cart $cart
     * @return \Illuminate\Http\Response
     */

    // Automaticamente, al pasar el id para cada instancia (Product, Cart)
    // De existir el recurso genera la instancia para cada modelo, en caso contrario retorna un 404
    public function destroy(Product $product, Cart $cart)
    {
        /*
         * Remueve el producto que pertenece al carrito
         * Desanexa de la relacion muchos a muchos
         * */
        $cart->products()
            ->detach($product->id);

        // Regenerando la cookie
        $cookie = $this->cartService->makeCookie($cart);

        return redirect()->back()->cookie($cookie);
    }
}
