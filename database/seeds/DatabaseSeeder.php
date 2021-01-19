<?php

use Illuminate\Database\Seeder;
use Database\Seeds\Essentials\EvalgridSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EvalgridSeeder::class);
    }
}
