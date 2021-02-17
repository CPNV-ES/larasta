<?php

use Illuminate\Database\Seeder;

class VisitsstatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $states = [
            [
                [ 'id' => 1 ],
                [
                    'stateName' => 'Proposée',
                    'slug' => 'pro',
                ]
            ],
            [
                [ 'id' => 2 ],
                [
                    'stateName' => 'Acceptée',
                    'slug' => 'acc',
                ]
            ],
            [
                [ 'id' => 3 ],
                [
                    'stateName' => 'Effectuée',
                    'slug' => 'eff',
                ]
            ],
            [
                [ 'id' => 4 ],
                [
                    'stateName' => 'Bouclée',
                    'slug' => 'bou',
                ]
            ]
        ];

        foreach($states as $state) {
            \DB::table('visitsstates')->updateOrInsert($state[0], $state[1]);
        }
    }
}