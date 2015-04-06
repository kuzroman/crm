<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // http://laravel.com/docs/4.2/schema#adding-columns
        Schema::create('orders', function($table) {
            $table->increments('id');

            $table->date('dateCreated');
            $table->date('dateCompleted');
            $table->string('id_buyer');
            $table->string('id_place');
            $table->text('desc');
            $table->string('price');
            $table->boolean('cash'); // безнал
            $table->boolean('paid'); // оплачено
            $table->boolean('finished'); // сдано

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
        Schema::drop('orders');
    }

}