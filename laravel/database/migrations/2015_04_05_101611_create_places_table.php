<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // http://laravel.com/docs/4.2/schema#adding-columns
        Schema::create('places', function($table) {
            $table->increments('id');
            $table->string('name');
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
        Schema::drop('places');
	}

}
