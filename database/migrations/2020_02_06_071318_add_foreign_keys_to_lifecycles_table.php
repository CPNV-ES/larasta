<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLifecyclesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('lifecycles', function(Blueprint $table)
		{
			$table->foreign('from_id', 'FKFrom')->references('id')->on('contractstates')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('to_id', 'FKTo')->references('id')->on('contractstates')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('lifecycles', function(Blueprint $table)
		{
			$table->dropForeign('FKFrom');
			$table->dropForeign('FKTo');
		});
	}

}
