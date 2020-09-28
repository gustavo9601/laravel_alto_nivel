{{--Especificando el archivo base de estructura--}}
@extends('layouts.app')

{{--Especificando el nombre de la seccion que sera dinamico--}}
@section('content')


    <h1>Order Details</h1>
    <h4 class="text-center"><strong>Gran Total: </strong> {{$cart->total}}</h4>

    <div class="text-center mb-3">
        <form
            action="{{route('orders.store')}}"
            method="POST" class="d-inline">

            @csrf
            <button type="submit" class="btn btn-success btn-block">Confirm Order</button>
        </form>
    </div>


    <hr>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            </thead>
            <tobdy>
                @foreach($cart->products as $product)
                    <tr>
                        <td>
                            <img width="100" src="{{asset($product->images->first()->path)}}" alt="">
                            {{$product->title}}
                        </td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->pivot->quantity}}</td>
                        <td>
                            {{--total es un attributo temporal "accesor"--}}
                            <strong>{{$product->total}}</strong>
                        </td>
                    </tr>
                @endforeach
            </tobdy>
        </table>
    </div>



@endsection
