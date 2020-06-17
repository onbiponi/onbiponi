<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dropdowns\KeyFeature;
use Faker\Generator as Faker;

$factory->define(KeyFeature::class, function (Faker $faker) {
    return [
        'category_id' => function(){
    		return App\Category::all()->random();
    	},
		'name' => $faker->name,
		'created_at' => $faker->dateTimeBetween('-13 days', '+0 days'),
		'updated_at' => $faker->dateTimeBetween('-13 days', '+0 days'),
    ];
});
