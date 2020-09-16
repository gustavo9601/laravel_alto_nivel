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
        dd($products);
        return view('products.index');
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
        dd($product);
        return view('products.show');
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
