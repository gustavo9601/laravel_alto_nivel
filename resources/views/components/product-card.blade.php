<div class="card m-1">
    <img class="card-img-top"
         src="{{asset($product->images->first()->path)}}"
         height="500"
         alt="">
    <div class="card-body">
        <h4 class="card-title text-right"><strong>$ {{$product->price}}</strong></h4>
        <h5 class="card-title">{{$product->title}}</h5>
        <p class="card-text">{{\Str::limit($product->description, $limit=30, $end='...')}}</p>
        <p class="card-text"><strong>{{$product->stock}} left</strong></p>


        {{--Validacion que si se envia la variable cart, muestre--}}
        @if (isset($cart))
            <form action="{{route('products.carts.destroy', ['cart' => $cart->id, 'product' => $product->id])}}"
                  method="POST" class="d-inline">

                {{--Falseando el metodo--}}
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger btn-block">Remove product</button>

            </form>
        @else
            {{--En caso contrario el boton de agregar se mostrara--}}
            <form action="{{route('products.carts.store', ['product' => $product->id])}}"
                  method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success btn-block">Add to cart</button>

            </form>

        @endif


    </div>
</div>
