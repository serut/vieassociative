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
			$table->boolean('active');
			$table->integer('id_proposition_post')->unsigned()->nullable();
			$table->integer('id_association')->unsigned();
			$table->foreign('id_association')->references('id')->on('association');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('proposition_post', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('id_author')->unsigned();
			$table->foreign('id_author')->references('id')->on('user');
			$table->integer('id_post')->unsigned();
			$table->foreign('id_post')->references('id')->on('post');
			$table->string('title');
			$table->string('content');
			$table->timestamps();
			$table->timestamp('wish_time_publish');
			$table->softDeletes();
		    $table->string('ip', 30);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('proposition_post');
		Schema::dropIfExists('post');
	}

}