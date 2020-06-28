<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorcyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motorcycles', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->tinyInteger('brand_id')->nullable()->unsigned()->index();
			$table->tinyInteger('model_id')->nullable()->unsigned()->index();
			$table->tinyInteger('body_type_id')->nullable()->unsigned()->index();
			$table->tinyInteger('displacement_id')->nullable()->unsigned()->index();
			$table->tinyInteger('engine_type_id')->nullable()->unsigned()->index();
			$table->smallInteger('maximum_power')->nullable()->unsigned();
			$table->smallInteger('maximum_torque')->nullable()->unsigned();
			$table->smallInteger('maximum_speed')->nullable()->unsigned();
			$table->smallInteger('milage')->nullable()->unsigned();
			$table->tinyInteger('made_origin_id')->nullable()->unsigned()->index();
			$table->tinyInteger('made_in_id')->nullable()->unsigned()->index();
			$table->string('image1', 30)->nullable();
			$table->string('image2', 30)->nullable();
			$table->string('image3', 30)->nullable();
			$table->string('image4', 30)->nullable();
			$table->string('image5', 30)->nullable();
			$table->string('image6', 30)->nullable();
			$table->string('image7', 30)->nullable();
			$table->string('image8', 30)->nullable();
			$table->string('image9', 30)->nullable();
			$table->string('image10', 30)->nullable();
			$table->string('after_sell_service')->nullable();
			$table->tinyInteger('ground_clearance_id')->nullable()->unsigned()->index();
			$table->string('suspension', 100)->nullable();
			$table->string('fuel_supply_system')->nullable();
			$table->smallInteger('fuel_tank_capacity')->nullable()->unsigned();
			$table->string('brake_system', 100)->nullable();
			$table->smallInteger('kerb_weight')->nullable()->unsigned();
			$table->tinyInteger('wheel_base')->nullable()->unsigned();
			$table->tinyInteger('gear_no')->nullable()->unsigned();
			$table->string('bore', 100)->nullable();
			$table->string('stroke', 100)->nullable();
			$table->tinyInteger('cylinder_no')->nullable()->unsigned();
			$table->string('comparison_ratio', 50)->nullable();
			$table->string('clutch_type', 100)->nullable();
			$table->tinyInteger('starting_system_id')->nullable()->unsigned()->index();
			$table->tinyInteger('cooling_system_id')->nullable()->unsigned()->index();
			$table->string('ignition', 100)->nullable();
			$table->string('riding_range', 100)->nullable();
			$table->smallInteger('length')->nullable()->unsigned();
			$table->smallInteger('height')->nullable()->unsigned();
			$table->smallInteger('width')->nullable()->unsigned();
			$table->smallInteger('seat_height')->nullable()->unsigned();
			$table->smallInteger('door_no')->nullable()->unsigned();
			$table->string('chassis_type', 100)->nullable();
			$table->tinyInteger('front_brake_id')->nullable()->unsigned()->index();
			$table->tinyInteger('rear_brake_id')->nullable()->unsigned()->index();
			$table->boolean('abs')->nullable();
			$table->smallInteger('registration_cost')->nullable()->unsigned();
			$table->tinyInteger('tyre_type_id')->nullable()->unsigned()->index();
			$table->string('battery_type', 100)->nullable();
			$table->float('battery_voltage', 4, 2)->nullable()->unsigned();
			$table->string('key_feature')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motorcycles');
    }
}
