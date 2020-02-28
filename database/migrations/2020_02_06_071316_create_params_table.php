<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('params', function(Blueprint $table)
		{
			$table->integer('param_id', true);
			$table->string('paramName', 45);
			$table->string('paramValueText')->nullable()->comment('Value if the parameter is of type text');
			$table->integer('paramValueInt')->nullable()->comment('Value if the parameter is of type int');
			$table->dateTime('paramValueDate')->nullable()->comment('Value if the parameter is of type date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('params');
	}

}
