<?php

use Illuminate\Database\Seeder;
use App\Wish;

class WishSeeder extends Seeder
{
    /**
     * Create 50 wishes.
     *
     * @return void
     */
    public function run()
    {
        factory(Wish::class, 50)->create();
    }
}
