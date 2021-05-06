<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeVisitIdNullableInEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->integer('visit_id')->nullable()->change();
            Schema::enableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->integer('visit_id')->nullable(false)->change();
            Schema::enableForeignKeyConstraints();
        });
    }
}
