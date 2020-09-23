<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // Tabla pivote entre Order y Product
    public function up()
    {
        Schema::create('productables', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->morphs('productable'); // En singular por que solo se refiere a un productable

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productables');
    }
}
