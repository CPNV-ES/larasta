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
        $intership=factory(App\Internship::class,3)->create();
    }
}
