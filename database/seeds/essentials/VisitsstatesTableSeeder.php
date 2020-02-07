<?php

use Illuminate\Database\Seeder;

class VisitsstatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('visitsstates')->delete();
        
        \DB::table('visitsstates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'stateName' => 'En cours',
            ),
        ));
        
        
    }
}