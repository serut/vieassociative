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
		Schema::create('answer', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('id_assoc')->unsigned()->nullable();
			$table->foreign('id_assoc')->references('id')->on('association');
			$table->integer('id_author')->unsigned();
			$table->foreign('id_author')->references('id')->on('user');
			$table->integer('id_answer')->unsigned()->nullable();
			$table->foreign('id_answer')->references('id')->on('answer');
			$table->integer('id_discussion')->unsigned()->nullable();
			$table->foreign('id_discussion')->references('id')->on('discussion');
			$table->integer('level');
			$table->integer('vote_up');
			$table->integer('vote_down');
			$table->text('content');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('discussion', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('level_access');
			$table->boolean('closed');
			$table->timestamps();
			$table->softDeletes();
		});
		
		Schema::create('history', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('type');
			$table->integer('state');
			$table->timestamp('deadline');
			$table->integer('id_discussion')->unsigned();
			$table->foreign('id_discussion')->references('id')->on('discussion');
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
		Schema::dropIfExists('history');
		Schema::dropIfExists('discussion');
		Schema::dropIfExists('answer');
	}
}