{{--Especificando el archivo base de estructura--}}
@extends('layouts.master')

{{--Especificando el nombre de la seccion que sera dinamico--}}
@section('content')


    <h1>List of Products</h1>

    {{--Utilizando semantica propia de laravel para verificar si es vacia o no la coleccion--}}
    {{--@if (!empty($products))--}}
    @empty(!$products)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>stock</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tobdy>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{\Str::limit($product->description, $limit=30, $end='...')}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->status}}</td>
                        </tr>
                    @endforeach
                </tobdy>
            </table>
        </div>
    @else
        <div class="alert alert-warning">
            The list of products is empty
        </div>
    @endempty


@endsection
