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
    </div>
</div>
