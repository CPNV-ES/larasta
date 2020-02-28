<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('companyName', 80);
			$table->integer('location_id')->nullable()->index('FKLocation_idx');
			$table->string('website')->nullable();
			$table->integer('contracts_id')->default(3)->index('FKTypeContrat')->comment('3 = entreprise (i know….)');
			$table->boolean('englishSkills')->default(0)->comment('Tells if good english skills are required for the internship');
			$table->boolean('driverLicence')->default(0)->comment('Tells if the intern must have a driver license (for external missions)');
			$table->boolean('mptOk')->default(1)->comment('Tells if a MPT student who is only 4 days on site is acceptable for the job');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companies');
	}

}
