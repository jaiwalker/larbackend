<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('links', function ($table) {
			$table->increments('id');
			$table->string('display');
			$table->string('url');
			$table->integer('main');
			$table->string('packageName');
			$table->timestamps();
			// We'll need to ensure that MySQL uses the InnoDB engine to
			// support the indexes, other engines aren't affected.
			$table->engine = 'InnoDB';
		});
		Jai\Backend\Link::create(array('display' => 'Links',
									   'url'     => 'Link',
									   'main'    => 1));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('links');
	}

}
