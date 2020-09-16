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

    }

    public function store()
    {

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

    }

    public function update($product)
    {

    }

    public function destroy($product)
    {

    }
}
