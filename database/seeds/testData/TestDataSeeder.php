<?php

use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    //TODO delete sql from database dir
    /**
     * Run the database seeds.
     *
     * Insert data for developpement
     * @return void
     */
    public function run()
    {      
        Schema::disableForeignKeyConstraints();
        $this->call(LocationsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(FlocksTableSeeder::class);
        $this->call(PersonsTableSeeder::class);
        $this->call(ContactinfosTableSeeder::class);
        $this->call(InternshipsTableSeeder::class);
        $this->call(VisitsTableSeeder::class);
        $this->call(DocumentsTableSeeder::class);
        $this->call(LogbooksTableSeeder::class);
        $this->call(RemarksTableSeeder::class);
        $this->call(WishesTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
