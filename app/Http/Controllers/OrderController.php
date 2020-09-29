<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

use App\Services\CartService;

class OrderController extends Controller
{


    public $cartService;
    // Inyeccion de dependencias, para contar con las funcionalidades de la clase
    // Variable de acceso global que toma la instancia de la inyeccion
    // El contructor recibe El nombre de la Clase y la variable de instancia
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;

        // Para ejecutar cuaqluier funcion de este controlador, se aplica el middleware
        $this->middleware('auth');
        // $this->middleware('auth')->only(['create', 'store']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = $this->cartService->getFormmCookie();

        // Si el carrito no existe, o no tiene productos agredados se redirige
        if (!isset($cart) || $cart->products->isEmpty()) {
            return redirect()
                ->back()
                ->withErrors('Your cart is Empty!!');
        }

        return view('orders.create')->with(['cart' => $cart]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        /*
         *
         * Otra forma de realizar el transacction controlando la excepcion
         *
         DB::beginTransaction();
          try {
                DB::insert(...);
                DB::commit();
          } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
           }
         *
         *
         * */


        // Englobando el query o proceso con la BD, dentro de una transacccion
        return \DB::transaction(function () use ($request) { // Indicandole que debe usar la variable $request de la funcion padre store

            $user = $request->user();

            // Con la relacion, en users de orders
            // aceder al atributo y con create se le proprociona los campos de la relacion y automaticamente se asosia a este usuaio
            $order = $user->orders()->create([
                'status' => 'pending'
            ]);

            $cart = $this->cartService->getFormmCookie();

            // mapWithKeys => recore la coleccion con los indices porporos de la coleccion
            // map => array nuevo con indices nuevos
            $cartProductsWithQuantity = $cart->products
                ->mapWithKeys(function ($product) {
                    // De esta forma se genera el nuevo array usando como indice, el id de cada producto
                    $element[$product->id] = ['quantity' => $product->pivot->quantity];
                    return $element;
                });

            // Asociara cada id del producto a la presente orden
            $order->products()->attach($cartProductsWithQuantity->toArray());

            return redirect()->route('orders.payments.create', ['order' => $order]);

            // Se puede especificar el numero de intentos a realizar dado el caso ocurra alguna novedad
        }, 2);


    }

}
