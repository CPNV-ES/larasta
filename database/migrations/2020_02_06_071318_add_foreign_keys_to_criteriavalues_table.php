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
			$table->foreign('criteria_id', 'fkcrit')->references('id')->on('criterias')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('evaluation_id', 'fkeval')->references('id')->on('evaluations')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
			$table->dropForeign('fkcrit');
			$table->dropForeign('fkeval');
		});
	}

}
