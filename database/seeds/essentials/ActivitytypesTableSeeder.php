<?php

use Illuminate\Database\Seeder;

class ActivitytypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('activitytypes')->delete();
        
        \DB::table('activitytypes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'RequireDetails' => 1,
                'typeActivityDescription' => 'Maintenance',
            ),
            1 => 
            array (
                'id' => 2,
                'RequireDetails' => 1,
                'typeActivityDescription' => 'Support utilisateurs',
            ),
            2 => 
            array (
                'id' => 3,
                'RequireDetails' => 1,
                'typeActivityDescription' => 'Documentation',
            ),
            3 => 
            array (
                'id' => 4,
                'RequireDetails' => 1,
                'typeActivityDescription' => 'Meeting',
            ),
            4 => 
            array (
                'id' => 5,
                'RequireDetails' => 1,
                'typeActivityDescription' => 'Programmation web',
            ),
            5 => 
            array (
                'id' => 6,
                'RequireDetails' => 1,
                'typeActivityDescription' => 'Programmation logicielle',
            ),
            6 => 
            array (
                'id' => 7,
                'RequireDetails' => 1,
                'typeActivityDescription' => 'Autre',
            ),
            7 => 
            array (
                'id' => 8,
                'RequireDetails' => 1,
                'typeActivityDescription' => 'Acquisition de connaissances',
            ),
            8 => 
            array (
                'id' => 9,
                'RequireDetails' => 1,
                'typeActivityDescription' => 'Intervention',
            ),
            9 => 
            array (
                'id' => 10,
                'RequireDetails' => 1,
                'typeActivityDescription' => 'Recherches',
            ),
            10 => 
            array (
                'id' => 11,
                'RequireDetails' => 0,
                'typeActivityDescription' => 'Absence',
            ),
            11 => 
            array (
                'id' => 12,
                'RequireDetails' => 0,
                'typeActivityDescription' => 'Cours Matu',
            ),
            12 => 
            array (
                'id' => 13,
                'RequireDetails' => 1,
                'typeActivityDescription' => 'Test',
            ),
        ));
        
        
    }
}