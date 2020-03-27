<?php

use App\Internship;
use App\Person;
use App\Wish;
use Faker\Generator as Faker;

$factory->define(Wish::class, function (Faker $faker) {

    /*
     * Potential ameliorations
     * - exactly 3 wishes per student
     * - wishes are ranked 1,2,3
     * - no duplicate internships amongst the wishes
     */

    // get all ids of students (teachers don't have wishes)
    $student_ids = Person::where('role', 0)->pluck('id')->all();

    //get all ids of internships of current year (can't wish for old internships)
    $internship_ids = Internship::whereYear('beginDate', '=', date('Y'))->pluck('id')->all();

    // rank goes from 1 to 3

    return [
        'internships_id' => $faker->randomElement($internship_ids),
        'persons_id' => $faker->randomElement($student_ids),
        'rank' => rand(1, 3),
    ];

    /*
     * not initialized :
     * - workPlaceDistance (default null)
     * - application (default 0)
     */
});
