<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCriteriavaluesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('criteriavalues', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('evaluation_id')->index('FKCritEval_idx');
			$table->integer('criteria_id')->index('FKCritvalCrit_idx');
			$table->integer('points');
			$table->string('studentComments', 1000)->nullable();
			$table->string('managerComments', 1000)->nullable();
			$table->string('contextSpecifics', 1000)->nullable()->comment('Allows to add details that are specific to this internship');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('criteriavalues');
	}

}
