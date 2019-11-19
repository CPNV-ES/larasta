<?php

use Illuminate\Database\Seeder;
use App\Wish;
use App\Person;

class WishesSeeder extends Seeder
{
    /**
     * Run the wishes seeds.
     *
     * @return void
     */
    public function run()
    {


        factory(Wish::class, 2)->create();
    }
}
