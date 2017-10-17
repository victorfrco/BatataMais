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
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');
        });

        Schema::table('brands', function($table){
            $table->foreign('logo_id')->references('id')->on('images');
        });

//        Schema::table('product_provider', function($table){
//            $table->foreign('product_id')->references('id')->on('products');
//            $table->foreign('provider_id')->references('id')->on('providers');
//        });
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
