<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeskHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desk_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('desk_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('status');
            $table->unsignedInteger('order_id');

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
        Schema::dropIfExists('desk_histories');
    }
}
