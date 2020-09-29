<div class="card m-1">

    {{--@dd($product->images->first()->path)--}}

    <div id="carousel-{{$product->id}}" class="carousel slide carousel-fade">
        <div class="carousel-inner">
            @foreach($product->images as $image)

                {{--
                $loop
                // Varaible dentro del foreach que tarea detos de la iteracion
                $loop->first // retorna si es la primer iteracion
                --}}
                <div class="carousel-item {{$loop->first ? 'active': ''}}">
                    <img class="d-block w-100 card-img-top"
                         src="{{asset($image->path)}}"
                         alt="">
                </div>
            @endforeach
                <a class="carousel-control-prev" href="#carousel-{{$product->id}}" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#carousel-{{$product->id}}" role="button" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

        </div>
    </div>



    <div class="card-body">
        <h4 class="card-title text-right"><strong>$ {{$product->price}}</strong></h4>
        <h5 class="card-title">{{$product->title}}</h5>
        <p class="card-text">{{\Str::limit($product->description, $limit=30, $end='...')}}</p>
        <p class="card-text"><strong>{{$product->stock}} left</strong></p>


        {{--Validacion que si se envia la variable cart, muestre--}}
        @if (isset($cart))
            <p class="card-text"><strong>{{ $product->pivot->quantity  }} in your cart ({{$product->total}})</strong>
            </p>
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
