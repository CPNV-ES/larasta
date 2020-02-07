<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('flocks', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('flockName', 45);
			$table->integer('startYear');
			$table->integer('classMaster_id')->index('fk_flocks_persons1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('flocks');
	}

}
