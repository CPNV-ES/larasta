<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationsectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evaluationsections', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('hasGrade')->comment('Indicates wether this section is evaluated with a grade or is just gathering informations\\n');
			$table->string('sectionName', 45);
			$table->integer('sectionType')->default(1)->comment('1 -> Formal evaluation\\n2 -> List of tasks\\n3 -> Feedback on training plan');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('evaluationsections');
	}

}
