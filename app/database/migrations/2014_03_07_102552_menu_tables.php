<?php

use Illuminate\Database\Migrations\Migration;

class MenuTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('wall_news', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('title');
            $table->integer('id_assoc')->unsigned()->nullable();
            $table->foreign('id_assoc')->references('id')->on('association');
            $table->timestamps();
        });
        Schema::create('wall_gallery', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('title');
            $table->integer('id_assoc')->unsigned()->nullable();
            $table->foreign('id_assoc')->references('id')->on('association');
            $table->integer('id_folder')->unsigned()->nullable();
            $table->foreign('id_folder')->references('id')->on('folder');
            $table->timestamps();
        });
        Schema::create('wall_static_page', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('title');
            $table->integer('id_assoc')->unsigned()->nullable();
            $table->foreign('id_assoc')->references('id')->on('association');
            $table->timestamps();
        });
        Schema::create('association_menu', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order');
            $table->integer('id_assoc')->unsigned()->nullable();
            $table->foreign('id_assoc')->references('id')->on('association');
            $table->integer('id_menu_parent')->unsigned()->nullable();
            $table->foreign('id_menu_parent')->references('id')->on('association_menu');
            $table->integer('id_wall_news')->unsigned()->nullable();
            $table->foreign('id_wall_news')->references('id')->on('wall_news');
            $table->integer('id_wall_gallery')->unsigned()->nullable();
            $table->foreign('id_wall_gallery')->references('id')->on('wall_gallery');
            $table->integer('id_wall_static_page')->unsigned()->nullable();
            $table->foreign('id_wall_static_page')->references('id')->on('wall_static_page');
            $table->timestamps();
        });
        Schema::table('news', function($table)
        {
            $table->dropForeign('news_id_assoc_foreign');
            $table->dropColumn('id_assoc');
            $table->integer('id_wall_news')->unsigned()->nullable();
            $table->foreign('id_wall_news')->references('id')->on('wall_news');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('association_menu');
        Schema::dropIfExists('wall_static_page');
        Schema::dropIfExists('wall_gallery');
        Schema::dropIfExists('wall_news');
	}

}