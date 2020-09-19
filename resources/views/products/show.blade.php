{{--Especificando el archivo base de estructura--}}
@extends('layouts.app')

{{--Especificando el nombre de la seccion que sera dinamico--}}
@section('content')

    {{--Incluyendo el archivo blade, y automaticamente recive acceso a la variable product--}}
   {{--@include('components.product-card', ['indice' => 'valor']);  // Se puede pasar parametros manualmente   --}}
   @include('components.product-card')
    {{-- Comentario blade --}}

@endsection
