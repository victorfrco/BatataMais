<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashes', function (Blueprint $table) {
            $table->increments('id');
            //['user_id', 'status', 'inicial_value', 'atual_value', 'final_value', 'opened_at', 'closed_at', 'obs']
	        $table->smallInteger('status')->nullable();
	        $table->unsignedInteger('user_id');
	        $table->decimal('inicial_value',8,2)->default(0);
	        $table->decimal('atual_value',8,2)->default(0);
	        $table->decimal('final_value',8,2)->default(0);
	        $table->dateTime('opened_at')->nullable();
	        $table->dateTime('closed_at')->nullable();
	        $table->string('obs')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashes');
    }
}
