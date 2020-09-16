{{--Especificando el archivo base de estructura--}}
@extends('layouts.master')

{{--Especificando el nombre de la seccion que sera dinamico--}}
@section('content')

    <h1>Crate a product</h1>
    <form action="{{ route('products.store')  }}" method="POST">
        @csrf
        <div class="form-row">
            <label for="title">Title</label>
            <input id="title" name="title" type="text" class="form-control" required>
        </div>

        <div class="form-row">
            <label for="description">Description</label>
            <input id="description" name="description" type="text" class="form-control" required>
        </div>
        <div class="form-row">
            <label for="price">Price</label>
            <input id="price" name="price" type="number" min="1.00" step="0.01" class="form-control" required>
        </div>
        <div class="form-row">
            <label for="stock">Stock</label>
            <input id="stock" name="stock" type="number" min="0" class="form-control" required>
        </div>
        <div class="form-row">
            <label for="status">Status</label>
            <select name="status" id="status" class="custom-select">
                <option value="" selected>Select...</option>
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>
            </select>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary btn-block">Create product</button>
        </div>
    </form>

@endsection
