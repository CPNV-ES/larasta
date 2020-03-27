<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLifecyclesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lifecycles', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('from_id')->index('FKFrom_idx');
			$table->integer('to_id')->index('FKTo_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lifecycles');
	}

}
