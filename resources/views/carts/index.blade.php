{{--Especificando el archivo base de estructura--}}
@extends('layouts.app')

{{--Especificando el nombre de la seccion que sera dinamico--}}
@section('content')
    <h1>Your cart</h1>

    <hr>

    {{--
    Si se envia un carrito nullo o
    Si esta vacio el carrito
    --}}

    @if(!isset($cart) || $cart->products->isEmpty())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Your cart is empty</h4>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            @foreach($cart->products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    {{--Incluyendo el archivo blade, y automaticamente recive acceso a la variable product--}}
                    {{--@include('components.product-card', ['indice' => 'valor']);  // Se puede pasar parametros manualmente   --}}
                    @include('components.product-card')
                </div>
            @endforeach
        </div>
    @endif

@endsection
