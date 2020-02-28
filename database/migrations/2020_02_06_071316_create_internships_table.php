<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInternshipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('internships', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('companies_id')->index('FKChez_idx');
			$table->dateTime('beginDate');
			$table->dateTime('endDate');
			$table->integer('responsible_id')->nullable()->index('FKResp_idx')->comment('The day-to-day manager');
			$table->integer('admin_id')->nullable()->index('FKRespAdmin_idx')->comment('The person who is responsible for the administrative matters');
			$table->integer('intern_id')->nullable()->index('FKStagiaire_idx')->comment('the student');
			$table->integer('contractstate_id')->nullable()->default(1)->index('FKStatusContrat_idx');
			$table->integer('previous_id')->nullable()->index('FKPrecedent_idx')->comment('The internship before this one in this company');
			$table->integer('parent_id')->nullable()->index('FKParent')->comment('The internship this one is based on');
			$table->text('internshipDescription')->nullable();
			$table->integer('grossSalary')->nullable()->default(1230)->comment('Dès 2017, tarifs « état de Vaud »:\n1er stage 1230.- , 2ème stage 1625.-');
			$table->dateTime('contractGenerated')->default('0000-01-01 00:00:00')->comment('Indicates that the contract has been generated and accepted by the user
');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('internships');
	}

}
