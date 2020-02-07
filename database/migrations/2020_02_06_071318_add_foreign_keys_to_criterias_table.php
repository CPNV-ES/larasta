<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCriteriasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('criterias', function(Blueprint $table)
		{
			$table->foreign('evaluationSection_id', 'fksection')->references('id')->on('evaluationsections')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('criterias', function(Blueprint $table)
		{
			$table->dropForeign('fksection');
		});
	}

}
