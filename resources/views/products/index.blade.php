{{--Especificando el archivo base de estructura--}}
@extends('layouts.app')

{{--Especificando el nombre de la seccion que sera dinamico--}}
@section('content')


    <h1>List of Products</h1>

    <hr>
    <a class="btn btn-success mb-3" href="{{route('products.create')}}">Create product</a>

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
                    <th>Actions</th>
                </tr>
                </thead>
                <tobdy>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->title}}</td>
                            <td>{{\Str::limit($product->description, $limit=30, $end='...')}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->status}}</td>
                            <td>
                                <a class="btn btn-link" href="{{route('products.show', $product->id)}}">Show</a>
                                <a class="btn btn-link" href="{{route('products.edit', $product->id)}}">Edit</a>

                                <form class="d-inline" action="{{route('products.destroy', ['product' =>  $product->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link">Delete</button>
                                </form>
                            </td>
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
