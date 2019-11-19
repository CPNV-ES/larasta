<?php

use Illuminate\Database\Seeder;
use App\Wish;

class WishesSeeder extends Seeder
{
    /**
     * Run the wishes seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO seed persons_id (should not be teacher)
        // TODO seed internships_id (ideally year is right)
        // TODO find range of rank
        // workPlaceDistance is initialized null
        // application is initialized 0
        Wish::insert([
            'internships_id' => 462,
            'persons_id' => 375,
            'rank' => 1,
        ]);
    }
}
