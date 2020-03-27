<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPersonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('persons', function(Blueprint $table)
		{
			$table->foreign('company_id', 'FKEntreprise')->references('id')->on('companies')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('location_id', 'FKLocationPerson')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('flock_id', 'FKVolee')->references('id')->on('flocks')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('persons', function(Blueprint $table)
		{
			$table->dropForeign('FKEntreprise');
			$table->dropForeign('FKLocationPerson');
			$table->dropForeign('FKVolee');
		});
	}

}
