<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // Usando el local scope avaialable
        $products = Product::available()
            ->with('images')  // Edager Loading -> Realizara la consulta, para traer para cada registro sus respectivas imagenes
                                // Debe existir la relacion pasada por parametro
                                // Si sonb varias relaciones ->with(['relacion_1', 'relacion_2'])
            ->get();

        return view('welcome')->with(
            [
                'products' => $products,
            ]
        );
    }
}
