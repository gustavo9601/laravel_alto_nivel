<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Cargando la factoria con el modelo, y creandolos en BD
        // factory(Modelo, cantidad_A_crear)->create();
        $users = factory(\App\User::class, 20)
            ->create()
            ->each(function ($user) {
                $image = factory(\App\Image::class)->states('user')->make();
                // Asociando para cada usuario su imagen correspondiente
                $user->image()->save($image);
            });

        $orders = factory(\App\Order::class, 10)
            ->make() // Genera las instancias de order pero no las inserta aun
            ->each(function ($order) use ($users) {
                // Le seteamos al id para cada ordern, aletariormente un id de users
                $order->customer_id = $users->random()->id;
                // Alamacenar en la BD
                $order->save();


                // Creamos pagos y los asocioamos de una vez para cada orden
                // De esta forma setea el id de la orden en el pago
                $payment = factory(\App\Payment::class)->make();

                // Forma 1
                // Se pasa en el create, el valor de order_id
                // $payment = factory(\App\Payment::class)->create(['order_id' => $order->id]);

                // Forma 2 - Asginacion manual del id de order
                // $payment->order_id = $order->id;
                // $payment->save();

                // Forma 3
                $order->payment()->save($payment);

            });


        $carts = factory(\App\Cart::class, 20)
            ->create();


        $products = factory(\App\Product::class, 100)
            ->create()
            ->each(function ($product) use ($orders, $carts) {
                // Se asocia aletaoriamente el id de producto y cantidad
                $order = $orders->random();
                $order->products()->attach([
                    $product->id => ['quantity' => mt_rand(1, 10)]
                ]);

                // Asociando para cada carrito productos y cantiad aletaroia
                $cart = $carts->random();
                $cart->products()->attach([
                    $product->id => ['quantity' => mt_rand(1, 10)]
                ]);


                // Asociando a un producto varias imagenes
                $images = factory(\App\Image::class, mt_rand(2,5))->make();
                // Almacenando masivamente cada instancia de imagenes al producto
                $product->images()->saveMany($images);


            });
    }
}
