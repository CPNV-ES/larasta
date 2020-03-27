<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLogbooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('logbooks', function(Blueprint $table)
		{
			$table->foreign('internships_id', 'fk_journal_stage1')->references('id')->on('internships')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('activitytypes_id', 'fk_journal_typeactivite1')->references('id')->on('activitytypes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('logbooks', function(Blueprint $table)
		{
			$table->dropForeign('fk_journal_stage1');
			$table->dropForeign('fk_journal_typeactivite1');
		});
	}

}
