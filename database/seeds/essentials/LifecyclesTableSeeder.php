<?php

use Illuminate\Database\Seeder;

class LifecyclesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lifecycles')->delete();
        
        \DB::table('lifecycles')->insert(array (
            0 => 
            array (
                'from_id' => 1,
                'id' => 2,
                'to_id' => 6,
            ),
            1 => 
            array (
                'from_id' => 1,
                'id' => 3,
                'to_id' => 4,
            ),
            2 => 
            array (
                'from_id' => 4,
                'id' => 9,
                'to_id' => 6,
            ),
            3 => 
            array (
                'from_id' => 6,
                'id' => 10,
                'to_id' => 8,
            ),
            4 => 
            array (
                'from_id' => 8,
                'id' => 12,
                'to_id' => 10,
            ),
            5 => 
            array (
                'from_id' => 10,
                'id' => 15,
                'to_id' => 9,
            ),
            6 => 
            array (
                'from_id' => 9,
                'id' => 17,
                'to_id' => 12,
            ),
            7 => 
            array (
                'from_id' => 2,
                'id' => 18,
                'to_id' => 6,
            ),
            8 => 
            array (
                'from_id' => 12,
                'id' => 19,
                'to_id' => 13,
            ),
            9 => 
            array (
                'from_id' => 12,
                'id' => 20,
                'to_id' => 14,
            ),
            10 => 
            array (
                'from_id' => 7,
                'id' => 40,
                'to_id' => 8,
            ),
            11 => 
            array (
                'from_id' => 3,
                'id' => 41,
                'to_id' => 1,
            ),
            12 => 
            array (
                'from_id' => 5,
                'id' => 42,
                'to_id' => 1,
            ),
            13 => 
            array (
                'from_id' => 11,
                'id' => 43,
                'to_id' => 1,
            ),
            14 => 
            array (
                'from_id' => 1,
                'id' => 44,
                'to_id' => 2,
            ),
        ));
        
        
    }
}