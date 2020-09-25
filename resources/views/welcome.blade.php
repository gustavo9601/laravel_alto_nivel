{{--Especificando el archivo base de estructura--}}
@extends('layouts.app')

{{--Especificando el nombre de la seccion que sera dinamico--}}
@section('content')
    <h1>Welcome to the Ecommerce GM</h1>

    @empty($products)
        <div class="alert alert-danger">
            No products yet !
        </div>

    @else
        <div class="row">
            @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                {{--Incluyendo el archivo blade, y automaticamente recive acceso a la variable product--}}
                {{--@include('components.product-card', ['indice' => 'valor']);  // Se puede pasar parametros manualmente   --}}
                @include('components.product-card')
            </div>
            @endforeach
        </div>
    @endempty

@endsection
