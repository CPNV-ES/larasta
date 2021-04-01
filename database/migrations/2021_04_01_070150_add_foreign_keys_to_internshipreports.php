<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInternshipreports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('internshipreports', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('reportstatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('internshipreports', function (Blueprint $table) {
            $table->dropForeign('status_id');
        });
    }
}
