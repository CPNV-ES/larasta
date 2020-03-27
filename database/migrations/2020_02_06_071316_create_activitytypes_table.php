<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivitytypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activitytypes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('typeActivityDescription', 50)->nullable();
			$table->boolean('RequireDetails')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activitytypes');
	}

}
