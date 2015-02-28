<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TurnosEventos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('turnos', function(Blueprint $table){
			$table->engine = 'InnoDB';
			
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('title');
			$table->text('description');
			$table->decimal('horas', 24, 1);
			$table->boolean('allDay');
			$table->string('backgroundColor');
			$table->string('borderColor');
			$table->string('textColor');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
		Schema::drop('turnos');
	}

}
