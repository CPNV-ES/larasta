<?php

use Illuminate\Database\Seeder;

class FlocksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('flocks')->delete();
        
        \DB::table('flocks')->insert(array (
            0 => 
            array (
                'classMaster_id' => 366,
                'flockName' => 'I10a',
                'id' => 1,
                'startYear' => 10,
            ),
            1 => 
            array (
                'classMaster_id' => 365,
                'flockName' => 'I10b',
                'id' => 2,
                'startYear' => 10,
            ),
            2 => 
            array (
                'classMaster_id' => 367,
                'flockName' => 'I11a',
                'id' => 4,
                'startYear' => 11,
            ),
            3 => 
            array (
                'classMaster_id' => 368,
                'flockName' => 'I11b',
                'id' => 5,
                'startYear' => 11,
            ),
            4 => 
            array (
                'classMaster_id' => 369,
                'flockName' => 'I12b',
                'id' => 6,
                'startYear' => 12,
            ),
            5 => 
            array (
                'classMaster_id' => 370,
                'flockName' => 'I12a',
                'id' => 7,
                'startYear' => 12,
            ),
            6 => 
            array (
                'classMaster_id' => 371,
                'flockName' => 'I13a',
                'id' => 8,
                'startYear' => 13,
            ),
            7 => 
            array (
                'classMaster_id' => 372,
                'flockName' => 'I13b',
                'id' => 9,
                'startYear' => 13,
            ),
            8 => 
            array (
                'classMaster_id' => 365,
                'flockName' => 'I14a',
                'id' => 10,
                'startYear' => 14,
            ),
            9 => 
            array (
                'classMaster_id' => 366,
                'flockName' => 'I14b',
                'id' => 11,
                'startYear' => 14,
            ),
            10 => 
            array (
                'classMaster_id' => 367,
                'flockName' => 'I15a',
                'id' => 12,
                'startYear' => 15,
            ),
            11 => 
            array (
                'classMaster_id' => 368,
                'flockName' => 'I15b',
                'id' => 13,
                'startYear' => 15,
            ),
        ));
        
        
    }
}