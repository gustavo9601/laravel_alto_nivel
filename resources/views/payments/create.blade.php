{{--Especificando el archivo base de estructura--}}
@extends('layouts.app')

{{--Especificando el nombre de la seccion que sera dinamico--}}
@section('content')


    <h1>Payment Details</h1>
    <h4 class="text-center"><strong>Gran Total: </strong> {{$order->total}}</h4>


    <div class="text-center mb-3">
        <form
            action="{{route('orders.payments.store', ['order' => $order->id])}}"
            method="POST" class="d-inline">

            @csrf
            <button type="submit" class="btn btn-success btn-block">Pay</button>
        </form>
    </div>


@endsection
