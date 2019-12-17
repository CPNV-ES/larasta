<?php

use Faker\Generator as Faker;

/*
Factory define to add data to the table visit
*/

$factory->define(App\Visit::class, function (Faker $faker) {

    return [
        'moment' => $faker->dateTimeBetween('now','+1 month'),
        'confirmed' => 1,
        'number' => $faker->randomNumber(1),
        'grade' => $faker->randomFloat(0,1,6),
        'mailstate' => 1,
        'internships_id' => function () {
            $internships=App\Internship::all()->random()->id;
            return $internships;
        },
        'visitsstates_id' => function (){
            $visitsstates=App\Visitsstate::all()->random()->id;
            return $visitsstates;
        },
    ];
});