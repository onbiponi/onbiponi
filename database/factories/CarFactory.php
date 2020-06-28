<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use Faker\Generator as Faker;

$factory->define(Car::class, function (Faker $faker) {
    return [
		'brand_id' => function(){
    		return App\Dropdowns\Brand::all()->random();	
    	},
		'model_id' => function(){
    		return App\Dropdowns\Model::all()->random();	
    	},
		'body_type_id' => function(){
    		return App\Dropdowns\BodyType::all()->random();	
    	},
		'package_id' => function(){
    		return App\Dropdowns\Package::all()->random();	
    	},
		'displacement_id' => function(){
    		return App\Dropdowns\Displacement::all()->random();	
    	},
		'manufacturing_year' => $faker->numberBetween(2012, 2020),
		'ground_clearance_id' => function(){
    		return App\Dropdowns\GroundClearance::all()->random();	
    	},
		'drive_type_id' => function(){
    		return App\Dropdowns\DriveType::all()->random();	
    	},
		'engine_type_id' => function(){
    		return App\Dropdowns\EngineType::all()->random();	
    	},
		'fuel_type_id' => function(){
    		return App\Dropdowns\FuelType::all()->random();	
    	},
		'condition_id' => function(){
    		return App\Dropdowns\Condition::all()->random();	
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
		'transmission_id' => function(){
    		return App\Dropdowns\Transmission::all()->random();	
    	},
		'selling_capacity_id' => function(){
    		return App\Dropdowns\SellingCapacity::all()->random();	
    	},
		'weight' => $faker->numberBetween(20000, 20200),
		'maximum_power' => $faker->numberBetween(2012, 2020),
		'maximum_torque' => $faker->numberBetween(2012, 2020),
		'emi_star_from' => $faker->numberBetween(2012, 2020),
		'gear_box_id' => function(){
    		return App\Dropdowns\GearBox::all()->random();	
    	},
		'loan_availability' => 1,
		'engine_check_warning' => $faker->numberBetween(2012, 2020),
		'wheel_base_id' => function(){
    		return App\Dropdowns\WheelBase::all()->random();	
    	},
		'mild_hybrid' => $faker->numberBetween(2012, 2020),
		'cylinder_id' => function(){
    		return App\Dropdowns\Cylinder::all()->random();	
    	},
		'boot_space' => $faker->numberBetween(2012, 2020),
		'front_suspension' => $faker->numberBetween(20000, 20200),
		'wheel_type_id' => function(){
    		return App\Dropdowns\WheelType::all()->random();	
    	},
		'wheel_size' => $faker->numberBetween(2012, 2020),
		'turning_radius' => $faker->numberBetween(2012, 2020),
		'tyre_type_id' => function(){
    		return App\Dropdowns\TyreType::all()->random();	
    	},
		'front_tyre_size' => $faker->numberBetween(2012, 2020),
		'rear_tyre_size' => $faker->numberBetween(2012, 2020),
		'steering_type' => $faker->numberBetween(2012, 2020),
		'steering_gear_type' => $faker->numberBetween(2012, 2020),
		'front_brake_id' => function(){
    		return App\Dropdowns\FrontBrake::all()->random();	
    	},
		'rear_brake_id' => function(){
    		return App\Dropdowns\RearBrake::all()->random();	
    	},
		'fuel_tank_capacity' => $faker->numberBetween(2012, 2020),
		'milage' => $faker->numberBetween(2012, 2020),
		'airbag' => $faker->numberBetween(2012, 2020),
		'wheel_base' => $faker->numberBetween(2012, 2020),
		'finance_upto' => $faker->numberBetween(2012, 2020),
		'auction_grade' => $faker->numberBetween(2, 5),
		'kms_driven' => $faker->numberBetween(2012, 2020),
		'registration_year' => $faker->numberBetween(2012, 2020),
		'key_feature' => $faker->numberBetween(2012, 2020),
		'interior_feature' => $faker->numberBetween(2012, 2020),
		'exterior_feature' => $faker->numberBetween(2012, 2020),
		'safety_security' => $faker->numberBetween(2012, 2020),
		'additional_feature' => $faker->numberBetween(2012, 2020),
		'created_at' => $faker->dateTimeBetween('-13 days', '+0 days'),
		'updated_at' => $faker->dateTimeBetween('-13 days', '+0 days'),
    ];
});
