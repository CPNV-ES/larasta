<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContactinfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contactinfos', function(Blueprint $table)
		{
			$table->foreign('persons_id', 'FKPers')->references('id')->on('persons')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('contacttypes_id', 'FKType')->references('id')->on('contacttypes')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contactinfos', function(Blueprint $table)
		{
			$table->dropForeign('FKPers');
			$table->dropForeign('FKType');
		});
	}

}
