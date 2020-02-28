<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactinfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contactinfos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('contacttypes_id')->default(0)->index('FKType_idx');
			$table->integer('persons_id')->index('FKPers_idx');
			$table->string('value', 45);
			$table->integer('rank')->default(99)->comment('to order display');
			$table->string('icon', 45)->default('question-sign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contactinfos');
	}

}
