<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashMovesTable extends Migration
{
//
//$table->increments('id');
//$table->unsignedInteger('original_order')->nullable();
//$table->decimal('total', 8,2)->nullable();
//$table->decimal('absolut_total', 8,2)->nullable();
//$table->decimal('discount', 8,2)->nullable();
//$table->decimal('debit', 8,2)->nullable();
//$table->decimal('credit', 8,2)->nullable();
//$table->decimal('money', 8,2)->nullable();
//$table->smallInteger('status');
//$table->boolean('associated');
//$table->smallInteger('pay_method')->nullable();
//$table->string('obs')->nullable();
//$table->timestamps();
//
//$table->unsignedInteger('client_id');
//$table->unsignedInteger('user_id');
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_moves', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total', 8,2)->nullable();
            $table->decimal('debit', 8,2)->nullable();
            $table->decimal('credit', 8,2)->nullable();
            $table->decimal('money', 8,2)->nullable();
            $table->string('obs')->nullable();
            $table->integer('type');

            $table->timestamps();

            $table->unsignedInteger('cash_id');
            $table->unsignedInteger('order_id')->nullable();
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
        Schema::dropIfExists('cash_moves');
    }
}
