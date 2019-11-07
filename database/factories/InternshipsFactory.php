<?php

use App\Companies;
use App\Internship;
use App\Persons;
use App\Contractstates;


use Faker\Generator as Faker;

$factory->define(Internship::class, function (Faker $faker) {
    return [
        "companies_id" => Companies::all()->random()->id,
        "beginDate" => $faker->dateTimeBetween('now', '+1 month'),
        "endDate" => $faker->dateTimeBetween('now', '+1 month'),
        "responsible_id" => Persons::all()->random()->id,
        "admin_id" => Persons::all()->random()->id,
        "intern_id" => Persons::all()->random()->id,
        "contractstate_id" => 7,
        "previous_id" => Internship::all()->random()->id,
        "internshipDescription" => $faker->realText(100),
        "grossSalary" => $faker->randomNumber(1),
        "contractGenerated" => $faker->dateTimeBetween('-56 year', '+63 month'),
    ];
});
