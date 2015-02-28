<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserProfile extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_profile', function(Blueprint $table){
			
			$table->engine = 'InnoDB';
			
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('asuntos_propios');
			$table->integer('vacaciones');
			$table->integer('permiso_urgente');
			$table->integer('baja');
			$table->integer('indisposicion');
			$table->integer('examen');
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
		Schema::drop('user_profile');
	}

}
