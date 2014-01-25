<?php

use Illuminate\Database\Migrations\Migration;

class WallNews extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partial_title', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->text('var1');
			$table->timestamps();
		});
		Schema::create('partial_text', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->text('var1');
			$table->timestamps();
		});
		Schema::create('partial_one_picture', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('var1');
			$table->foreign('var1')->references('name')->on('img');
			$table->timestamps();
		});
		Schema::create('partial_youtube', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('var1');
			$table->timestamps();
		});
		Schema::create('partial_soundcloud', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('var1');//URL
			$table->timestamps();
		});
		Schema::create('news', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('id_assoc')->unsigned()->nullable();
			$table->foreign('id_assoc')->references('id')->on('association');
			//$table->timestamp('wish_time_publish');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('partial', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('id_news')->unsigned()->nullable();
			$table->foreign('id_news')->references('id')->on('news');
		    $table->integer('order');
		    $table->string('partial_type');
		    $table->integer('partial_id');
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
		Schema::dropIfExists('partial');
		Schema::dropIfExists('news');
		Schema::dropIfExists('partial_title');
		Schema::dropIfExists('partial_text');
		Schema::dropIfExists('partial_one_picture');
		Schema::dropIfExists('partial_youtube');
		Schema::dropIfExists('partial_soundcloud');
	}

}