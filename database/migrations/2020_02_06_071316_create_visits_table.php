<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visits', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('moment')->nullable();
			$table->boolean('confirmed')->default(0);
			$table->integer('number')->nullable()->comment('rank (first or second visit)');
			$table->integer('internships_id')->index('FKVisite_idx');
			$table->float('grade', 10, 0)->nullable()->comment('Results of the evaluation');
			$table->integer('visitsstates_id')->index('fk_visits_visitsstates1_idx');
			$table->integer('mailstate')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('visits');
	}

}
