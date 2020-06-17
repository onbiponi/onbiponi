<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bicycle;
use Faker\Generator as Faker;

$factory->define(Bicycle::class, function (Faker $faker) {
    return [
		'condition_id' => function(){
    		return App\Dropdowns\Condition::all()->random();	
    	},
		'brand_id' => function(){
    		return App\Dropdowns\Brand::all()->random();	
    	},
		'model_id' => function(){
    		return App\Dropdowns\Model::all()->random();	
    	},
		'frame_size' => $faker->numberBetween(20000, 20200),
		'frame_material' => $faker->numberBetween(20000, 20200),
		'suspension' => $faker->numberBetween(20000, 20200),
		'gear_no' => $faker->numberBetween(1, 20),
		'wheel_type_id' => function(){
    		return App\Dropdowns\WheelType::all()->random();	
    	},
		'wheel_size' => $faker->numberBetween(20000, 20200),
		'shifter' => $faker->numberBetween(20000, 20200),
		'made_origin_id' => function(){
    		return App\Dropdowns\MadeOrigin::all()->random();	
    	},
		'weight' => $faker->numberBetween(20000, 20200),
		'image1' => 'default.jpg',
		'image2' => 'default.jpg',
		'image3' => 'default.jpg',
		'image4' => 'default.jpg',
		'image5' => 'default.jpg',
		'image6' => 'default.jpg',
		'image7' => 'default.jpg',
		'image8' => 'default.jpg',
		'image9' => 'default.jpg',
		'image10' => 'default.jpg',
		'after_sell_service' => $faker->numberBetween(20000, 20200),
		'shifter_lever' => $faker->numberBetween(20000, 20200),
		'front_derailleur' => $faker->numberBetween(20000, 20200),
		'rear_derailleur' => $faker->numberBetween(20000, 20200),
		'rims' => $faker->numberBetween(20000, 20200),
		'hub_quality' => $faker->numberBetween(20000, 20200),
		'cassette' => $faker->numberBetween(20000, 20200),
		'recommended_biker_height' => $faker->numberBetween(20000, 20200),
		'tyre_type_id' => function(){
    		return App\Dropdowns\TyreType::all()->random();	
    	},
		'tyre_size' => $faker->numberBetween(20000, 20200),
		'crank' => $faker->numberBetween(20000, 20200),
		'seat_post' => $faker->numberBetween(20000, 20200),
		'chain' => $faker->numberBetween(20000, 20200),
		'pedal' => $faker->numberBetween(20000, 20200),
		'saddle' => $faker->numberBetween(20000, 20200),
		'headset' => $faker->numberBetween(20000, 20200),
		'handlebar' => $faker->numberBetween(20000, 20200),
		'grip' => $faker->numberBetween(20000, 20200),
		'stem' => $faker->numberBetween(20000, 20200),
		'brake_system' => $faker->numberBetween(20000, 20200),
		'key_feature' => $faker->numberBetween(20000, 20200),
		'created_at' => $faker->dateTimeBetween('-13 days', '+0 days'),
		'updated_at' => $faker->dateTimeBetween('-13 days', '+0 days'),
    ];
});
