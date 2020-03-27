<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWishesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wishes', function(Blueprint $table)
		{
			$table->foreign('persons_id', 'SouhaitePar')->references('id')->on('persons')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('internships_id', 'SouhaiteStage')->references('id')->on('internships')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wishes', function(Blueprint $table)
		{
			$table->dropForeign('SouhaitePar');
			$table->dropForeign('SouhaiteStage');
		});
	}

}
