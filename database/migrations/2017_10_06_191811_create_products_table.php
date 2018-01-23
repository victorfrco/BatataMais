<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('price_cost', 8,2)->default(0);
            $table->decimal('price_resale', 8,2)->default(0);
            $table->decimal('price_discount', 8,2)->default(0);
            $table->decimal('price_card', 8,2)->default(0);
            $table->integer('qtd')->nullable();
            $table->string('barcode')->nullable();
            $table->timestamps();

            $table->unsignedInteger('brand_id');
            //$table->unsignedInteger('provider_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
