<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMutualCalcsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mutual_calcs', function(Blueprint $table)
		{
			$table->increments('id');

            $table->date('date');
            $table->string('id_order');
            $table->string('id_buyer');
            $table->string('id_employee');
            $table->string('id_kindcost');
            $table->string('sum');
            $table->text('desc');

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
		Schema::drop('mutual_calcs');
	}

}
