<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dropdowns\AdditionalFeature;
use Faker\Generator as Faker;

$factory->define(AdditionalFeature::class, function (Faker $faker) {
    return [
		'name' => $faker->name,
		'created_at' => $faker->dateTimeBetween('-13 days', '+0 days'),
		'updated_at' => $faker->dateTimeBetween('-13 days', '+0 days'),
    ];
});
