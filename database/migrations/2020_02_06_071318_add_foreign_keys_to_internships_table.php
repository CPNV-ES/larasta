<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInternshipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('internships', function(Blueprint $table)
		{
			$table->foreign('companies_id', 'FKChez')->references('id')->on('companies')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('parent_id', 'FKParent')->references('id')->on('internships')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('previous_id', 'FKPrecedent')->references('id')->on('internships')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('responsible_id', 'FKResp')->references('id')->on('persons')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('admin_id', 'FKRespAdmin')->references('id')->on('persons')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('intern_id', 'FKStagiaire')->references('id')->on('persons')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('contractstate_id', 'FKStatusContrat')->references('id')->on('contractstates')->onUpdate('NO ACTION')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('internships', function(Blueprint $table)
		{
			$table->dropForeign('FKChez');
			$table->dropForeign('FKParent');
			$table->dropForeign('FKPrecedent');
			$table->dropForeign('FKResp');
			$table->dropForeign('FKRespAdmin');
			$table->dropForeign('FKStagiaire');
			$table->dropForeign('FKStatusContrat');
		});
	}

}
