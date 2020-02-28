<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('companies', function(Blueprint $table)
		{
			$table->foreign('location_id', 'FKLocation')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('contracts_id', 'FKTypeContrat')->references('id')->on('contracts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('companies', function(Blueprint $table)
		{
			$table->dropForeign('FKLocation');
			$table->dropForeign('FKTypeContrat');
		});
	}

}
