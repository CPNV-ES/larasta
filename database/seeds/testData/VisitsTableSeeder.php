<?php

use Illuminate\Database\Seeder;

class VisitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('visits')->delete();
        
        \DB::table('visits')->insert(array (
            0 => 
            array (
                'confirmed' => 1,
                'grade' => 6.0,
                'id' => 3,
                'internships_id' => 25,
                'mailstate' => 0,
                'moment' => '2004-05-23 14:25:10',
                'number' => 1,
                'visitsstates_id' => 1,
            ),
        ));
        
        
    }
}