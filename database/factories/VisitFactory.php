<?php

use Faker\Generator as Faker;

/*
Factory define to add data to the table visit
*/

$factory->define(App\Visit::class, function (Faker $faker) {

    return [
        'moment' => $faker->date('Y-m-d H:i:s'),
        'confirmed' => 1,
        'number' => $faker->randomNumber(1),
        'grade' => $faker->randomFloat(1,1,6),
        'mailstate' => 1,
        'internships_id' => function () {
            $internships=App\Internship::all();
            $numberInternships=count($internships);
            $randomNumber= random_int(0,$numberInternships);
            return $internships[$randomNumber]->id;
        },
        'visitsstates_id' => 1,
    ];
});