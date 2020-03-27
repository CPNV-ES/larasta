<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWishesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wishes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('internships_id')->index('SouhaiteStage_idx');
			$table->integer('persons_id')->index('SouhaitePar_idx')->comment('The student who placed the wish');
			$table->integer('rank')->comment('Order of preference of the student');
			$table->integer('workPlaceDistance')->nullable()->comment('Distance in km between the workplace and the student’s home');
			$table->integer('application')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wishes');
	}

}
