<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContractstatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contractstates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('stateDescription', 45);
			$table->text('details')->nullable();
			$table->integer('openForApplication')->default(0)->comment('This field says that students will see the internships in that state in the wishes matrix ');
			$table->integer('openForRenewal')->default(0)->comment('This field says that the internships in that state will appear in the internship renewal page');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contractstates');
	}

}
