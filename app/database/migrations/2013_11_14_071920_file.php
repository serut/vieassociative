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
			$table->increments('id');
			$table->string('name');
			$table->string('extension');
			$table->integer('id_user')->unsigned()->nullable();
			$table->foreign('id_user')->references('id')->on('user');
			$table->timestamps();
		});
		Schema::create('img', function($table)
		{
			$table->engine = 'InnoDB';
			$table->string('name');
			$table->string('extension');
			$table->integer('id_user')->unsigned()->nullable();
			$table->foreign('id_user')->references('id')->on('user');
			$table->timestamps();
			$table->primary('name');
		});
		Schema::create('img_other_version', function($table)
		{
			$table->engine = 'InnoDB';
			$table->string('name');
			$table->foreign('name')->references('name')->on('img');
			$table->string('purpose');
		});
		Schema::create('folder', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});
		Schema::create('folder_file_img', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('id_folder')->unsigned()->nullable();
			$table->foreign('id_folder')->references('id')->on('folder');

			$table->string('name_img');
			$table->foreign('name_img')->references('name')->on('img');
			$table->integer('id_file')->unsigned()->nullable();
			$table->foreign('id_file')->references('id')->on('file');
			$table->integer('id_assoc')->unsigned()->nullable();
			$table->foreign('id_assoc')->references('id')->on('association');

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
		Schema::dropIfExists('file');
		Schema::dropIfExists('img');
		Schema::dropIfExists('img_other_version');
		Schema::dropIfExists('folder');
		Schema::dropIfExists('file');
	}

}