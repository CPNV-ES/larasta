<?php

use App\ReportStatus;
use Illuminate\Database\Seeder;
use Database\Seeds\Essentials;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ActivitytypesTableSeeder::class);
        $this->call(ContacttypesTableSeeder::class);
        $this->call(ContractsTableSeeder::class);
        $this->call(ContractstatesTableSeeder::class);
        $this->call(EvalgridSeeder::class);
        $this->call(LifecyclesTableSeeder::class);
        $this->call(ParamsTableSeeder::class);
        $this->call(VisitsstatesTableSeeder::class);
        $this->call(ReportStatusSeeder::class);
    }
}
