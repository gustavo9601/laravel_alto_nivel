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
        $products = factory(\App\Product::class, 50)->create();
        $users = factory(\App\User::class, 10)->create();

    }
}
