<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'github_id' => 1,
                'name' => 'Admin',
                'email' => 'larasta.admin@cpnv.ch',
                'avatar' => 'https://avatars2.githubusercontent.com/u/7465241?s=400&u=8f09d78acd01a658af4d919fa518029c2b20b688&v=4',
                'role' => 3
            ),
        ));
        
        
    }
}