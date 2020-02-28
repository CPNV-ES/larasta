<?php

use Illuminate\Database\Seeder;

class WishesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('wishes')->delete();
        
        
        
    }
}