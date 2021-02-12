<?php

use Illuminate\Database\Seeder;

class ParamsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('params')->delete();

        \DB::table('params')->insert(array (
            4 =>
            array (
                'param_id' => 5,
                'paramName' => 'internship1Start',
                'paramValueDate' => '2000-02-01 00:00:00',
                'paramValueInt' => NULL,
                'paramValueText' => NULL,
            ),
            5 =>
            array (
                'param_id' => 6,
                'paramName' => 'internship1End',
                'paramValueDate' => '2000-08-31 00:00:00',
                'paramValueInt' => NULL,
                'paramValueText' => NULL,
            ),
            6 =>
            array (
                'param_id' => 7,
                'paramName' => 'internship2Start',
                'paramValueDate' => '2000-09-01 00:00:00',
                'paramValueInt' => NULL,
                'paramValueText' => NULL,
            ),
            7 =>
            array (
                'param_id' => 8,
                'paramName' => 'internship2End',
                'paramValueDate' => '2000-01-31 00:00:00',
                'paramValueInt' => NULL,
                'paramValueText' => NULL,
            ),
            8 =>
            array (
                'param_id' => 9,
                'paramName' => 'internship1Salary',
                'paramValueDate' => NULL,
                'paramValueInt' => 1230,
                'paramValueText' => NULL,
            ),
            9 =>
            array (
                'param_id' => 10,
                'paramName' => 'internship2Salary',
                'paramValueDate' => NULL,
                'paramValueInt' => 1650,
                'paramValueText' => NULL,
            ),
        ));


    }
}
