<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Motorcycle;
use Faker\Generator as Faker;

$factory->define(Motorcycle::class, function (Faker $faker) {
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
		'displacement_id' => function(){
    		return App\Dropdowns\Displacement::all()->random();	
    	},
		'engine_type_id' => function(){
    		return App\Dropdowns\EngineType::all()->random();	
    	},
		'maximum_power' => $faker->numberBetween(20000, 20200),
		'maximum_torque' => $faker->numberBetween(20000, 20200),
		'maximum_speed' => $faker->numberBetween(20000, 20200),
		'milage' => $faker->numberBetween(20000, 20200),
		'made_origin_id' => function(){
    		return App\Dropdowns\MadeOrigin::all()->random();	
    	},
		'made_in_id' => function(){
    		return App\Dropdowns\MadeIn::all()->random();	
    	},
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
		'ground_clearance_id' => function(){
    		return App\Dropdowns\GroundClearance::all()->random();	
    	},
		'suspension' => $faker->numberBetween(20000, 20200),
		'fuel_supply_system' => $faker->numberBetween(20000, 20200),
		'fuel_tank_capacity' => $faker->numberBetween(20000, 20200),
		'brake_system' => $faker->numberBetween(20000, 20200),
		'kerb_weight' => $faker->numberBetween(20000, 20200),
		'gear_no' => $faker->numberBetween(1, 5),
		'bore' => $faker->numberBetween(20000, 20200),
		'stroke' => $faker->numberBetween(20000, 20200),
		'cylinder_no' => $faker->numberBetween(1, 10),
		'comparison_ratio' => $faker->numberBetween(20000, 20200),
		'outch_type' => $faker->numberBetween(20000, 20200),
		'starting_system_id' => function(){
    		return App\Dropdowns\StartingSystem::all()->random();	
    	},
		'cooling_system_id' => function(){
    		return App\Dropdowns\CoolingSystem::all()->random();	
    	},
		'ignition' => $faker->numberBetween(20000, 20200),
		'riding_range' => $faker->numberBetween(20000, 20200),
		'length' => $faker->numberBetween(20000, 20200),
		'height' => $faker->numberBetween(20000, 20200),
		'width' => $faker->numberBetween(20000, 20200),
		'seat_height' => $faker->numberBetween(20000, 20200),
		'door_no' => $faker->numberBetween(20000, 20200),
		'chassis_type' => $faker->numberBetween(20000, 20200),
		'front_brake_id' => function(){
    		return App\Dropdowns\FrontBrake::all()->random();	
    	},
		'rear_brake_id' => function(){
    		return App\Dropdowns\RearBrake::all()->random();	
    	},
		'abs' => $faker->numberBetween(0, 1),
		'tyre_type_id' => function(){
    		return App\Dropdowns\TyreType::all()->random();	
    	},
		'battery_type' => $faker->numberBetween(20000, 20200),
		'battery_voltage' => $faker->numberBetween(1, 99),
		'registration_year' => $faker->numberBetween(2000, 2020),
		'kms_driven' => $faker->numberBetween(20000, 20200),
		'key_feature' => $faker->numberBetween(20000, 20200),
		'created_at' => $faker->dateTimeBetween('-13 days', '+0 days'),
		'updated_at' => $faker->dateTimeBetween('-13 days', '+0 days'),
    ];
});
