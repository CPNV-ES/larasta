<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('flocks', function(Blueprint $table)
		{
			$table->foreign('classMaster_id', 'fk_flocks_persons1')->references('id')->on('persons')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('flocks', function(Blueprint $table)
		{
			$table->dropForeign('fk_flocks_persons1');
		});
	}

}
