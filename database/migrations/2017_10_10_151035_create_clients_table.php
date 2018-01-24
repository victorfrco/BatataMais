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
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('nickname');
            $table->string('phone1', 12);
            $table->string('phone2', 12)->nullable();
            $table->string('email')->nullable();
            $table->string('cpf', 11)->nullable();
            $table->string('cnpj', 11)->nullable();
            $table->string('adr_street')->nullable();
            $table->integer('adr_number')->nullable();
            $table->string('adr_neighborhood')->nullable();
            $table->string('adr_cep', 8)->nullable();
            $table->string('adr_compl')->nullable();
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
        Schema::drop('clients');
    }
}
