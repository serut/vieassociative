<?php

use Illuminate\Database\Migrations\Migration;

class HistoryAssociation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discussion', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('level_access');
			$table->boolean('closed');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('answer', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('id_assoc')->unsigned()->nullable();
			$table->foreign('id_assoc')->references('id')->on('association');
			$table->integer('id_user')->unsigned()->nullable();
			$table->foreign('id_user')->references('id')->on('user');
			$table->integer('id_answer')->unsigned()->nullable();
			$table->foreign('id_answer')->references('id')->on('answer');
			$table->integer('id_discussion')->unsigned()->nullable();
			$table->foreign('id_discussion')->references('id')->on('discussion');
			$table->integer('level');
			$table->integer('vote');
			$table->text('content');
			$table->timestamps();
			$table->softDeletes();
		});

		
		Schema::create('proposition', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('finished');
			$table->timestamp('deadline');
			$table->string('title');
			$table->integer('id_discussion')->unsigned();
			$table->foreign('id_discussion')->references('id')->on('discussion');
			$table->integer('id_assoc')->unsigned();
			$table->foreign('id_assoc')->references('id')->on('association');
			$table->integer('type_query');
			$table->integer('id_answer')->unsigned()->nullable();
			$table->foreign('id_answer')->references('id')->on('answer');
			$table->text('data');
			$table->text('where');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('vote', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('id_user')->unsigned();
			$table->foreign('id_user')->references('id')->on('user');
			$table->integer('id_answer')->unsigned();
			$table->foreign('id_answer')->references('id')->on('answer');
			$table->integer('value');
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
		Schema::dropIfExists('vote');
		Schema::dropIfExists('proposition');
		Schema::dropIfExists('answer');
		Schema::dropIfExists('discussion');
	}
}