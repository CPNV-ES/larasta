<?php

use Illuminate\Database\Seeder;

class ContacttypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contacttypes')->delete();
        
        \DB::table('contacttypes')->insert(array (
            0 => 
            array (
                'contactTypeDescription' => 'Email',
                'id' => 1,
            ),
            1 => 
            array (
                'contactTypeDescription' => 'Tel Fixe',
                'id' => 2,
            ),
            2 => 
            array (
                'contactTypeDescription' => 'Tel Portable',
                'id' => 3,
            ),
        ));
        
        
    }
}