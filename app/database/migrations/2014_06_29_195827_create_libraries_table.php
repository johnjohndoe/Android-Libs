<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLibrariesTable extends Migration {

	public function up()
	{
		Schema::create('libraries', function(Blueprint $table) {
			$table->increments('id');
			$table->text('title');
			$table->text('short_desc');
			$table->string('long_desc');
			$table->string('github', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('libraries');
	}
}