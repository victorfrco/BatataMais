<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class FkTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function($table){
            $table->foreign('brand_id')->references('id')->on('brands');
        });

        Schema::table('brands', function($table){
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('itens', function($table){
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('order_id')->references('id')->on('orders');
        });

        Schema::table('orders', function($table){
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('cash_moves', function($table){
            $table->foreign('cash_id')->references('id')->on('cashes');
            $table->foreign('user_id')->references('id')->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
