<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persons', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('firstname', 45);
			$table->string('lastname', 45);
			$table->integer('flock_id')->nullable()->index('FKVolee_idx')->comment('flock = volée');
			$table->integer('company_id')->nullable()->index('FKEntreprise_idx');
			$table->integer('location_id')->nullable()->index('FKLocationPerson_idx');
			$table->string('initials', 3)->nullable();
			$table->dateTime('upToDateDate')->nullable()->comment('Date/time at which the person has read all remarks');
			$table->integer('intranetUserId')->nullable()->default(0)->comment('IntranetUser ID');
			$table->boolean('obsolete')->default(0);
			$table->integer('mpt')->nullable()->comment('For a student: is in MPT class');
			$table->integer('role')->default(0)->comment('0=Student
1=Teacher
2=company');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('persons');
	}

}
