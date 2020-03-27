<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    //TODO delete sql from database dir
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ContractstatesTableSeeder::class);
        $this->call(LifecyclesTableSeeder::class);
        $this->call(ContractsTableSeeder::class);
        $this->call(ContacttypesTableSeeder::class);
        $this->call(ActivitytypesTableSeeder::class);
        $this->call(ParamsTableSeeder::class);
        $this->call(VisitsstatesTableSeeder::class);
    }
}
