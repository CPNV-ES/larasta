<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('address1', 80)->nullable();
			$table->string('address2', 80)->nullable();
			$table->integer('postalCode')->nullable();
			$table->string('city', 45)->nullable();
			$table->float('lat', 10, 0)->nullable();
			$table->float('lng', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locations');
	}

}
