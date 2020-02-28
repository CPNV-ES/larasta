<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVisitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('visits', function(Blueprint $table)
		{
			$table->foreign('internships_id', 'FKVisite')->references('id')->on('internships')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('visitsstates_id', 'fk_visits_visitsstates1')->references('id')->on('visitsstates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('visits', function(Blueprint $table)
		{
			$table->dropForeign('FKVisite');
			$table->dropForeign('fk_visits_visitsstates1');
		});
	}

}
