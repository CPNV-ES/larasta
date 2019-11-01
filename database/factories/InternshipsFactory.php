<?php

use App\Companies;
use App\Internship;
use App\Persons;
use App\Contractstates;


use Faker\Generator as Faker;

$factory->define(Internship::class, function (Faker $faker) {
    return [
        "companies_id" => Companies::all()->random()->first()->id,
        "beginDate" => $faker->dateTimeBetween('now', '+1 month'),
        "endDate" => $faker->dateTimeBetween('now', '+1 month'),
        "responsible_id" => Persons::all()->random()->first()->id,
        "admin_id" => Persons::all()->random()->first()->id,
        "intern_id" => Persons::all()->random()->first()->id,
        "contractstate_id" => Contractstates::all()->random()->first()->id == null ? null : null,
        "previous_id" => Internship::all()->random(1)->first()->id,
        "internshipDescription" => $faker->realText(100),
        "grossSalary" => $faker->randomNumber(1),
        "contractGenerated" => $faker->dateTimeBetween('-56 year', '+63 month'),
    ];
});
