<?php

use Illuminate\Database\Migrations\Migration;

class MigrationAssociation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('association', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name');
			$table->string('slug');
			$table->string('acronym');
			$table->string('legal_name');
			$table->string('goal');
			$table->string('website_url');
			$table->date('official_date_creation');
			$table->string('headquarter');
			$table->boolean('admitted_public_utility');
			$table->integer('nb_publications');
			$table->integer('nb_photos');
			$table->integer('nb_administrator');
			$table->integer('nb_evenements');
			$table->text('statuts');
			$table->text('internal_regulation');
			$table->string('contact_adress'); // an email for contact the association
            $table->integer('plan');


			$table->string('page_facebook');
			$table->string('page_googleplus');
			$table->string('page_youtube');
			$table->string('page_paypal');
			$table->string('page_twitter');


			$table->integer('id_folder')->unsigned();
			$table->foreign('id_folder')->references('id')->on('folder');

			$table->string('cover_img')->nullable();
			$table->foreign('cover_img')->references('name')->on('img');
			$table->string('logo_img')->nullable();
			$table->foreign('logo_img')->references('name')->on('img');
			//$table->string('url_name'); // USELESS ?
			$table->softDeletes();
			$table->timestamps();
		});


		Schema::create('user_association', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->integer('id_user')->unsigned();
			$table->foreign('id_user')->references('id')->on('user');
			$table->integer('id_assoc')->unsigned();
			$table->foreign('id_assoc')->references('id')->on('association');
			$table->string('link',30);

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
		Schema::dropIfExists('user_association');
		Schema::dropIfExists('association');
	}

}