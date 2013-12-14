<?php

use Illuminate\Database\Migrations\Migration;

class Posts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('id_association')->unsigned();
			$table->foreign('id_association')->references('id')->on('association');
			$table->string('title');
			$table->text('text');
			$table->timestamp('wish_time_publish');
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
		Schema::dropIfExists('post');
	}

}