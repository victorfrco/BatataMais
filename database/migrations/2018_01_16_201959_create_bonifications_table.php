<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('bonifications', function (Blueprint $table) {
		    $table->increments('id');
		    $table->timestamps();

		    $table->unsignedInteger('client_id');
		    $table->unsignedInteger('item_id');
		    $table->unsignedInteger('order_id');
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
	    Schema::dropIfExists('bonifications');
    }
}
