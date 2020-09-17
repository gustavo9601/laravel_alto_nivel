{{--Especificando el archivo base de estructura--}}
@extends('layouts.app')

{{--Especificando el nombre de la seccion que sera dinamico--}}
@section('content')

    <h1>{{$product->title}}</h1>
    <p>{{$product->description}}</p>
    {{-- Comentario blade --}}

@endsection
