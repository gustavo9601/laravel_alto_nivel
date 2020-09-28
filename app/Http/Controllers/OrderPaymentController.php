<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\Services\CartService;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        return view('payments.create')->with(['order' => $order]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        // En este apartado, al carrito existente se le quitaran por bd todos los productos asociados
        $cart = $this->cartService->getFormmCookie()
            ->products()
            ->detach();  // Eliminado los productos asociados al carrito actual

        // Se crea el pago a travez de la relacion order con payment, y se asocia el pago a la orden
        $order->payment()->create([
           'amount' => $order->total,
           'payed_at' => now()
        ]);

        // Actualizando el status
        $order->status = 'payed';
        // Actualizando en la BD cambio del status
        $order->save();

        return redirect()->route('main')->with(['success' => "Thanks! Your payment for {$order->total} was successful."]);

    }


}
