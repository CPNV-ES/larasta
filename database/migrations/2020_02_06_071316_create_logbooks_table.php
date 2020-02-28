<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogbooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logbooks', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('internships_id')->index('fk_journal_stage1_idx');
			$table->dateTime('entryDate')->nullable();
			$table->float('duration', 10, 0)->nullable()->comment('Hours spent on the task');
			$table->string('activityDescription', 2000)->nullable();
			$table->integer('activitytypes_id')->index('fk_journal_typeactivite1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('logbooks');
	}

}
