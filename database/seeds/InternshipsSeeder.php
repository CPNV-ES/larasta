<?php

use Illuminate\Database\Seeder;

class InternshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create 10 internships
        $internship=factory(App\Internship::class,10)->create();
    }
}
