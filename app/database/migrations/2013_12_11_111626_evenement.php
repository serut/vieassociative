<?php

use Illuminate\Database\Migrations\Migration;

/**
 * Class Evenement
 */
class Evenement extends Migration {

	/**
	 * Run the migrations.
	 * @todo THESE TABLES ARE NOT USED RIGHT NOW
	 * @return void
	 */
	public function up()
	{
		/*
		Schema::create('evenement', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->integer('id_assoc');
			$table->integer('id_user');
			$table->integer('id_lieu');

			$table->boolean('active');

			$table->timestamps();
			$table->dateTime('date_deb');
			$table->dateTime('date_fin');

			$table->string('titre', 100);
			$table->text('texte');
			$table->integer('type_repetition'); // ?????

			$table->integer('id_photo');
			$table->integer('id_type_evenement');
			$table->integer('id_type_sous_evenement');

			$table->string('ip', 15);
		});




		Schema::create('evenement_repete_jour', function($table){
			$table->engine = 'InnoDB';

			$table->integer('id_evenement');
			$table->integer('id_jour');

			$table->time('hd');
			$table->time('hf');
		});





		Schema::create('lieu', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->string('libelle');
			$table->string('ville');
			$table->float('latitude');
			$table->float('longitude');
		});

		Schema::create('type_evenement', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->string('libelle');
		});

		Schema::create('type_sous_evenement', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->integer('id_type_evenement');
			$table->string('libelle');
		});
		*/
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		/*
		Schema::dropIfExists('evenement');
		Schema::dropIfExists('evenement_repete_jour');
		Schema::dropIfExists('lieu');
		Schema::dropIfExists('type_evenement');
		Schema::dropIfExists('type_sous_evenement');
		*/
	}

}