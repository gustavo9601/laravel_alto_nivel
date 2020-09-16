<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        //$products = \DB::table('products')->get();
        $products = Product::all();

        return view('products.index')->with(
            ['products' => $products]
        );
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        /*$product = Product::create([
           'title' => $request->input('title'),
           'description' => $request->input('description'),
           'price' => $request->input('price'),
           'stock' => $request->input('stock'),
           'status' => $request->input('status'),
        ]);*/
        // pasando el resquest->all() en base a los campos en el modelo $fillable realazara la insercion
        $product = Product::create($request->all());

        dd($product);
    }

    public function show($product)
    {
        //$product = \DB::table('products')->where('id', $product)->first();
        //$product = \DB::table('products')->find($product);
        //$product = Product::find($product);
        $product = Product::findOrFail($product);

        return view('products.show')->with(
            ['product' => $product]
        );
    }

    public function edit($product)
    {
        $product = Product::findOrFail($product);
        return view('products.edit')->with([
            'product' => $product
        ]);
    }

    public function update($productId)
    {
        $product = Product::findOrFail($productId);

        $product->update(\request()->all());

        return $product;
    }

    public function destroy($product)
    {
        $product = Product::findOrFail($product);
        $product->delete();
        return $product;
    }
}
