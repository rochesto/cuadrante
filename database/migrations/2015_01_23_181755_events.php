<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Events extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('turno_id')->unsigned();
			$table->string('title');
			$table->text('description');
			$table->boolean('allDay');
			$table->date('start');
			$table->date('end');
			$table->string('url');
			$table->string('className');
			$table->string('color');
			$table->string('backgroundColor');
			$table->string('borderColor');
			$table->string('textColor');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			// $table->foreign('turno_id')->references('id')->on('turnos');
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
		Schema::drop('events');
	}

}
