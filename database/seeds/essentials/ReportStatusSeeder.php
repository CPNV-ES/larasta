<?php

use Illuminate\Database\Seeder;

class ReportStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('reportstatus')->delete();

        \DB::table('reportstatus')->insert(array(
            0 => array('status' => 'Brouillon'),
            1 => array('status' => 'Livré'),
            2 => array('status' => 'Evalué'),
        ));
    }
}
