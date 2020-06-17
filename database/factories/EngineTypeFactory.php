<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dropdowns\EngineType;
use Faker\Generator as Faker;

$factory->define(EngineType::class, function (Faker $faker) {
    return [
		'category_id' => function(){
    		return App\Category::all()->random();	
    	},
        'name' => $faker->name,
		'updated_at' => $faker->dateTimeBetween('-13 days', '+0 days'),
		'created_at' => $faker->dateTimeBetween('-15 days', '-14 days')
    ];
});
