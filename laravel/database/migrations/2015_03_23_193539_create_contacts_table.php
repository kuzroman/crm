<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('contacts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->integer('cell_1');
            $table->string('cell_2');
            $table->string('email');
            $table->timestamps(); // вроде как обязательное поле для всех миграций!
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('contacts');
	}

}
