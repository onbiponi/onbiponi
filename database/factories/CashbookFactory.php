<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cashbook;
use Faker\Generator as Faker;

$factory->define(Cashbook::class, function (Faker $faker) {
    return [
		'action' => 'credit',
        'amount' => $faker->numberBetween(50, 100),
		'user_id' => 1,
		'order_id' =>  function(){
    		return App\Order::all()->random();	
    	},
		'description' => $faker->paragraph,
		'updated_at' => $faker->dateTimeBetween('-13 days', '+0 days'),
		'created_at' => $faker->dateTimeBetween('-15 days', '-14 days')
    ];
});
