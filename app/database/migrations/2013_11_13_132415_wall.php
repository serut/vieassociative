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
		Schema::create('partial_title', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->text('title');
			$table->timestamps();
		});
		Schema::create('partial_text', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->text('text');
			$table->timestamps();
		});
		Schema::create('partial_one_picture', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name_img');
			$table->foreign('name_img')->references('name')->on('img');
			$table->timestamps();
		});
		Schema::create('partial_youtube', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('url');
			$table->timestamps();
		});
		Schema::create('partial_soundcloud', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('url');
			$table->timestamps();
		});
		Schema::create('wall', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('type');
			$table->integer('id_assoc')->unsigned()->nullable();
			$table->foreign('id_assoc')->references('id')->on('association');
			$table->timestamp('wish_time_publish');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('partial', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('id_wall')->unsigned()->nullable();
			$table->foreign('id_wall')->references('id')->on('wall');
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
		Schema::dropIfExists('wall');
		Schema::dropIfExists('partial_title');
		Schema::dropIfExists('partial_text');
		Schema::dropIfExists('partial_one_picture');
		Schema::dropIfExists('partial_youtube');
		Schema::dropIfExists('partial_soundcloud');
	}

}