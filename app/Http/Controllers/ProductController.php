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
        $rules = [
          'title' => 'required|max:255',
          'description' => 'required|max:1000',
          'price' => 'required|min:1',
          'stock' => 'required|min:0',
          'status' => 'required|in:available,unavailable',
        ];

        $request->validate($rules);

        if($request->input('status') === 'available' && $request->input('stock') == 0){
            // Creando una sesion con laravel
            // session()->put('error', 'If available must have stock');
            // Eliminando la sesion
            // session()->forget('error');

            // Permite crear una sesion temporal, hasta la primer peticion despues de esta, despues se eliminara
            // session()->flash('error', 'If available must have stock');

            // redirije a la pagina anterior, y con withnput se envia un array con las variables
            // pára este caso le enviamos extamente lo que el usuario envio para que el old('') funcione en el formulario
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors('If available must have stock');  // Permite  pushear a la variable global $errors el texto pasado por parametro
        }



        /*$product = Product::create([
           'title' => $request->input('title'),
           'description' => $request->input('description'),
           'price' => $request->input('price'),
           'stock' => $request->input('stock'),
           'status' => $request->input('status'),
        ]);*/
        // pasando el resquest->all() en base a los campos en el modelo $fillable realazara la insercion
        $product = Product::create($request->all());

        // session()->flash('success', "The product with id {$product->id} was created");

        // Redireccionando al index
        // redirect()->back()   // redirige al anterior
        // redirect()->action('NameController@function')   // a una accion puntual
        return redirect()
            ->route('products.index')
            ->with(['success' => "The product with id {$product->id} was created"]);
            // ->withNameVariable(value)  permite setear en la misma variable el nombre de la variable de la sesion que se enviara

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

        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'price' => 'required|min:1',
            'stock' => 'required|min:0',
            'status' => 'required|in:available,unavailable',
        ];

        \request()->validate($rules);


        $product->update(\request()->all());

        // Redireccionando al index
        // redirect()->back()   // redirige al anterior
        // redirect()->action('NameController@function')   // a una accion puntual
        return redirect()
            ->route('products.index')
            ->with(['success' => "The product with id {$product->id} was updated"]);

    }

    public function destroy($product)
    {
        $product = Product::findOrFail($product);
        $product->delete();

        // Redireccionando al index
        // redirect()->back()   // redirige al anterior
        // redirect()->action('NameController@function')   // a una accion puntual
        return redirect()
            ->route('products.index'
            ->with(['success' => "The product with id {$product->id} was deleted"]);
    }
}
