<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCriteriasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('criterias', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('criteriaName', 45);
			$table->string('criteriaDetails', 1000)->nullable()->default('NULL');
			$table->integer('maxPoints')->nullable();
			$table->integer('evaluationSection_id')->index('FKCritSection_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('criterias');
	}

}
