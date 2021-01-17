<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCriteriavaluesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('criteriavalues', function(Blueprint $table)
		{
			$table->foreign('criteria_id', 'FKCritvalCrit')->references('id')->on('criterias')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('evaluation_id', 'FKCritvalEval')->references('id')->on('evaluations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('criteriavalues', function(Blueprint $table)
		{
			$table->dropForeign('FKCritvalCrit');
			$table->dropForeign('FKCritvalEval');
		});
	}

}
