<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRemarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('remarks', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('remarkType')->comment('1: Company\n2: Person\n3: -\n4: Visit\n5: Internship');
			$table->integer('remarkOn_id');
			$table->timestamp('remarkDate')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('author', 45);
			$table->text('remarkText');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('remarks');
	}

}
