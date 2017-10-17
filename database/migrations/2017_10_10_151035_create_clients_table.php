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
            $table->string('nickname');
            $table->string('phone1', 12);
            $table->string('phone2', 12);
            $table->string('email');
            $table->string('cpf', 11);
            $table->boolean('associated');
            $table->string('associated_id');
            $table->string('obs');
            $table->string('adr_street');
            $table->integer('adr_number');
            $table->string('adr_neighborhood');
            $table->string('adr_cep', 8);
            $table->string('adr_compl');
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
