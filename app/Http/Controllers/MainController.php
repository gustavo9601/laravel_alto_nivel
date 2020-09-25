<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // Usando el local scope avaialable
        $products = Product::available()->get();

        return view('welcome')->with(
            [
                'products' => $products,
            ]
        );
    }
}
