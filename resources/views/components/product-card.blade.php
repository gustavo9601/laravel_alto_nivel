<h1>{{$product->id}} - {{$product->title}}</h1>
<p>{{\Str::limit($product->description, $limit=30, $end='...')}}</p>
<p>{{$product->price}}</p>
<p>{{$product->stock}}</p>
<p>{{$product->status}}</p>
