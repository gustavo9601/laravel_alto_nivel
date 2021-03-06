{{--Especificando el archivo base de estructura--}}
@extends('layouts.app')

{{--Especificando el nombre de la seccion que sera dinamico--}}
@section('content')

    <h1>Crate a product</h1>
    <form action="{{ route('products.update', $product->id)  }}" method="POST">
        @csrf

        {{--Falseara en el formulario el motodo, ya que no existe por defecto en los navegadores--}}
        @method('PUT')
        <div class="form-row">
            <label for="title">Title</label>
            {{-- valor/codnicioe ?? en caso contrario
             Este operador ternario verifica que si da true la condicione retornara el valor de la condicion en caso contrario lo seguido a los ??
             --}}
            <input id="title" name="title" type="text" class="form-control" required
                   value="{{old('title') ?? $product->title}}">
        </div>

        <div class="form-row">
            <label for="description">Description</label>
            <input id="description" name="description" type="text" class="form-control" required
                   value="{{old('description') ?? $product->description}}">
        </div>
        <div class="form-row">
            <label for="price">Price</label>
            <input id="price" name="price" type="number" min="1.00" step="0.01" class="form-control" required
                   value="{{old('price') ?? $product->price}}">
        </div>
        <div class="form-row">
            <label for="stock">Stock</label>
            <input id="stock" name="stock" type="number" min="0" class="form-control" required
                   value="{{old('stock') ?? $product->stock}}">
        </div>
        <div class="form-row">
            <label for="status">Status</label>
            <select name="status" id="status" class="custom-select">
                {{--Dependiendo del valor recibido pondra en selected el option adecuado--}}
                <option
                    value="available" {{(old('status') == 'available' ? 'selected' : $product->status === 'available') ? 'selected' : ''}}>
                    Available
                </option>
                <option
                    value="unavailable" {{(old('status') == 'unavailable' ? 'selected' : $product->status === 'unavailable') ? 'selected' : ''}}>
                    Unavailable
                </option>
            </select>
        </div>
        <div class="form-row mt-3">
            <button type="submit" class="btn btn-primary btn-block">Update product</button>
        </div>
    </form>

@endsection
