<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('evaluations', function(Blueprint $table)
		{
			$table->foreign('visit_id', 'fkvisit')->references('id')->on('visits')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('evaluations', function(Blueprint $table)
		{
			$table->dropForeign('fkvisit');
		});
	}

}
