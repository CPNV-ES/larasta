<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evaluations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->boolean('editable')->default(1);
			$table->integer('visit_id')->index('fk_evaluations_visits1_idx');
			$table->string('template_name', 45)->nullable()->default('NULL')->unique('template_name_UNIQUE')->comment('The name that can be used to take this evaluation’s structure as a template for new evaluations.');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('evaluations');
	}

}
