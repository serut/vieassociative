<?php

use Illuminate\Database\Migrations\Migration;

class MigrationUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('user', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->string('username')->unique('username');
			$table->string('email')->unique('email');
			$table->string('password',128);
			$table->string('level')->default('user');
			$table->string('firstname');
			$table->string('lastname');

			$table->timestamps();

			$table->integer('state');
		});

		Schema::create('connexion_tentative', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('ip',15);
			$table->timestamps();
		});

		Schema::create('user_token', function($table){
			$table->engine = 'InnoDB';
			$table->integer('id_user')->unsigned();
			$table->foreign('id_user')->references('id')->on('user');
			$table->string('token',250);
			$table->timestamp('date_fin');
		});


		Schema::create('password_reset', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('id_user')->unsigned();
			$table->foreign('id_user')->references('id')->on('user');
			$table->string('pass',250);
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
		Schema::dropIfExists('password_reset');
		Schema::dropIfExists('user_token');
		Schema::dropIfExists('connexion_tentative');
		Schema::dropIfExists('user');
    	DB::statement('SET FOREIGN_KEY_CHECKS = 1');
		
	}

}