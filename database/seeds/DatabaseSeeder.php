<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		// factory(App\User::class, 200)->create();
		// factory(App\Traffic::class, 1000)->create();
		// factory(App\Role::class, 5)->create();
		// factory(App\Chat::class, 500)->create();
		// factory(App\Category::class,8)->create();
		// factory(App\Payment::class, 5)->create();
		// factory(App\Supplier::class, 5)->create();
		// factory(App\Size::class, 5)->create();
		// factory(App\Color::class, 5)->create();
		// factory(App\Unit::class, 3)->create();
		// factory(App\Product::class, 100)->create();
		// factory(App\Shipper::class, 5)->create();
		// factory(App\OrderStatus::class, 8)->create();
		// factory(App\Order::class, 200)->create();
		// factory(App\OrderDetail::class, 200)->create();
		// factory(App\Permission::class, 15)->create();
		// factory(App\Dropdowns\BodyType::class, 15)->create();
		// factory(App\Dropdowns\Brand::class, 15)->create();
		// factory(App\Dropdowns\Model::class, 15)->create();
		// factory(App\Dropdowns\Package::class, 15)->create();
		// factory(App\Dropdowns\Condition::class, 15)->create();
		// factory(App\Dropdowns\CoolingSystem::class, 15)->create();
		// factory(App\Dropdowns\Cylinder::class, 15)->create();
		// factory(App\Dropdowns\Displacement::class, 15)->create();
		// factory(App\Dropdowns\DriveType::class, 15)->create();
		// factory(App\Dropdowns\EngineType::class, 15)->create();
		// factory(App\Dropdowns\FrontBrake::class, 15)->create();
		// factory(App\Dropdowns\FuelType::class, 15)->create();
		// factory(App\Dropdowns\GearBox::class, 15)->create();
		// factory(App\Dropdowns\GroundClearance::class, 15)->create();
		// factory(App\Dropdowns\MadeIn::class, 15)->create();
		// factory(App\Dropdowns\MadeOrigin::class, 15)->create();
		// factory(App\Dropdowns\RearBrake::class, 15)->create();
		// factory(App\Dropdowns\SellingCapacity::class, 15)->create();
		// factory(App\Dropdowns\StartingSystem::class, 15)->create();
		// factory(App\Dropdowns\Transmission::class, 15)->create();
		// factory(App\Dropdowns\TyreType::class, 15)->create();
		// factory(App\Dropdowns\WheelBase::class, 15)->create();
		// factory(App\Dropdowns\WheelType::class, 15)->create();
		// factory(App\Car::class, 100)->create();
		// factory(App\Motorcycle::class, 100)->create();
		// factory(App\Bicycle::class, 100)->create();
		// factory(App\Dropdowns\KeyFeature::class, 20)->create();
		// factory(App\Dropdowns\InteriorFeature::class, 20)->create();
		// factory(App\Dropdowns\ExteriorFeature::class, 20)->create();
		// factory(App\Dropdowns\SafetySecurity::class, 20)->create();
		// factory(App\Dropdowns\AdditionalFeature::class, 20)->create();
		// factory(App\Dropdowns\UserType::class, 15)->create();
		// factory(App\HomeSlider::class, 5)->create();
		factory(App\Cashbook::class, 200)->create();
    }
}
