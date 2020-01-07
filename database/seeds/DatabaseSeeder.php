<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VisitsSeeder::class);
        // $this->call(UsersTableSeeder::class);
        $this->call([
            ContacttypeTableSeeder::class,
            InternshipsSeeder::class
          ]);
    }
}
