<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        // Todas las acciones o rutas de este controlador estan protegidas pro el middleware
        // $this->middleware('auth');
        // Ya no es necesario ya que el middleware se le coloco diretaente en la ruta

        /*
         * De esta forma se especifica a que funciones aplique a ciertas funciones
         * $this->middleware('auth')->only(['index']);
         *
         * De esta forma se especifica a que funciones debe exeprtar el midleware
         * $this->middleware('auth')->except(['index', 'show']);
        */
    }

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

    // Inyeccion implicita del Validator de los campos ProductRequest, y que de ser valida creara una instancia con los valores enviados
    public function store(ProductRequest $requestValidation)
    {
        /*
        // Validacion manual
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'price' => 'required|min:1',
            'stock' => 'required|min:0',
            'status' => 'required|in:available,unavailable',
          ];

          $request->validate($rules);
        */


        // Validacion manual, que se delego en el form request

        /* if ($requestValidation->input('status') === 'available' && $requestValidation->input('stock') == 0) {
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
                ->withInput($requestValidation->validated())
                ->withErrors('If available must have stock');  // Permite  pushear a la variable global $errors el texto pasado por parametro
        }*/


        // Creando manualmente la instancia del producto y asignando los campos
        /*$product = Product::create([
           'title' => $request->input('title'),
           'description' => $request->input('description'),
           'price' => $request->input('price'),
           'stock' => $request->input('stock'),
           'status' => $request->input('status'),
        ]);*/
        // pasando el resquest->all() en base a los campos en el modelo $fillable realazara la insercion
        // $product = Product::create($requestValidation->all());

        // con ->validated()  va retornar unicamente los valores que se han validado en el form request
        $product = Product::create($requestValidation->validated());

        // session()->flash('success', "The product with id {$product->id} was created");

        // Redireccionando al index
        // redirect()->back()   // redirige al anterior
        // redirect()->action('NameController@function')   // a una accion puntual
        return redirect()
            ->route('products.index')
            ->with(['success' => "The product with id {$product->id} was created"]);
        // ->withNameVariable(value)  permite setear en la misma variable el nombre de la variable de la sesion que se enviara

    }

    // Product $product -> inyeccion implicta de modelos
    // Debe recibir el id y laravel de existir retorna una instancia de la clase modelo Product
    public function show(Product $product)
    {
        // $product = \DB::table('products')->where('id', $product)->first();
        // $product = \DB::table('products')->find($product);
        // $product = Product::find($product);
        // $product = Product::findOrFail($product);

        return view('products.show')->with(
            ['product' => $product]
        );
    }

    public function edit(Product $product)
    {
        // $product = Product::findOrFail($product);
        return view('products.edit')->with([
            'product' => $product
        ]);
    }

    // Usando la inyeccion de validador de los campos ProductRequest
    public function update(ProductRequest $requestValidation, Product $product)
    {
        // $product = Product::findOrFail($productId);

        /*
        // Validacion Manual
        $rules = [
               'title' => 'required|max:255',
               'description' => 'required|max:1000',
               'price' => 'required|min:1',
               'stock' => 'required|min:0',
               'status' => 'required|in:available,unavailable',
           ];

        \request()->validate($rules);
        */

        // con ->validated()  va retornar unicamente los valores que se han validado en el form request
        // $product->update($requestValidation->all());
        $product->update($requestValidation->validated());

        // Redireccionando al index
        // redirect()->back()   // redirige al anterior
        // redirect()->action('NameController@function')   // a una accion puntual
        return redirect()
            ->route('products.index')
            ->with(['success' => "The product with id {$product->id} was updated"]);

    }

    public function destroy(Product $product)
    {
        // $product = Product::findOrFail($product);
        $product->delete();

        // Redireccionando al index
        // redirect()->back()   // redirige al anterior
        // redirect()->action('NameController@function')   // a una accion puntual
        return redirect()
            ->route('products.index')
            ->with(['success' => "The product with id {$product->id} was deleted"]);
    }
}
