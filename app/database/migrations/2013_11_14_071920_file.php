<?php

use Illuminate\Database\Migrations\Migration;

class File extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('file', function($table)
		{
			$table->engine = 'InnoDB';
			$table->string('name');
			$table->integer('id_assoc')->unsigned()->nullable();
			$table->foreign('id_assoc')->references('id')->on('association');
			$table->integer('id_user')->unsigned()->nullable();
			$table->foreign('id_user')->references('id')->on('user');
			$table->string('extension');
			$table->timestamps();
		});
		Schema::create('img', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('original')->unsigned()->nullable();
			$table->foreign('original')->references('id')->on('file');
			$table->string('thumb')->unsigned()->nullable();
			$table->foreign('thumb')->references('id')->on('file');
			$table->string('crop')->unsigned()->nullable();
			$table->foreign('crop')->references('id')->on('file');
			$table->integer('id_assoc')->unsigned()->nullable();
			$table->foreign('id_assoc')->references('id')->on('association');
			$table->string('text');
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
		//
	}

}