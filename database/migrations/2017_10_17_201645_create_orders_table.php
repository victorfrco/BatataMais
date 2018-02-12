<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('original_order')->nullable();
	        $table->decimal('total', 8,2)->nullable();
	        $table->decimal('absolut_total', 8,2)->nullable();
	        $table->decimal('discount', 8,2)->nullable();
            $table->smallInteger('status');
            $table->boolean('associated');
            $table->smallInteger('pay_method')->nullable();
            $table->string('obs')->nullable();
            $table->timestamps();

            $table->unsignedInteger('client_id');
            $table->unsignedInteger('user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
