<?php

use App\Internship;
use App\Person;
use App\Wish;
use Faker\Generator as Faker;

$factory->define(Wish::class, function (Faker $faker) {
    // get all ids of students (teachers don't have wishes)
    $student_ids = Person::where('role', 0)->pluck('id')->all();

    //get all ids of internships of current year (can't wish for old internships)
    $internship_ids = Internship::whereYear('beginDate', '=', date('Y'))->pluck('id')->all();

    // TODO find range of rank
    /**
     * not initialized :
     * - workPlaceDistance (default null)
     * - application (default 0)
     */
    return [
        'internships_id' => $faker->randomElement($internship_ids),
        'persons_id' => $faker->randomElement($student_ids),
        'rank' => 1,
    ];
});
