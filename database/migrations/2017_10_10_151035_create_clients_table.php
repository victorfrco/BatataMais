<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
/*            ['name', 'cpf', 'tel', 'tel2', 'email', 'obs', 'associado', 'endereco', 'nickname'];*/
            $table->increments('id');
            $table->string('name');
            $table->string('cpf', 11);
            $table->string('tel');
            $table->string('tel2');
            $table->string('email');
            $table->string('obs');
            $table->boolean('associado');
            $table->integer('endereco');
            $table->string('nickname');
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
        Schema::drop('clients');
    }
}
