<?php

use Illuminate\Database\Migrations\Migration;

class Wall extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wall', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('type');
			$table->integer('id_assoc')->unsigned()->nullable();
			$table->foreign('id_assoc')->references('id')->on('association');
			$table->integer('id_post')->unsigned()->nullable();
			$table->foreign('id_post')->references('id')->on('post');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('wall');
	}

}