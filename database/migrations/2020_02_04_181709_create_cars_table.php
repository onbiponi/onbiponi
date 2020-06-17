<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->tinyInteger('brand_id')->nullable()->unsigned()->index();
			$table->tinyInteger('model_id')->nullable()->unsigned()->index();
			$table->tinyInteger('body_type_id')->nullable()->unsigned()->index();
			$table->tinyInteger('package_id')->nullable()->unsigned()->index();
			$table->tinyInteger('displacement_id')->nullable()->unsigned()->index();
			$table->smallInteger('manufacturing_year')->nullable()->unsigned();
			$table->tinyInteger('ground_clearance_id')->nullable()->unsigned()->index();
			$table->tinyInteger('drive_type_id')->nullable()->unsigned()->index();
			$table->tinyInteger('engine_type_id')->nullable()->unsigned()->index();
			$table->tinyInteger('fuel_type_id')->nullable()->unsigned()->index();
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
			$table->tinyInteger('transmission_id')->nullable()->unsigned()->index();
			$table->smallInteger('seating_capacity')->nullable()->unsigned();
			$table->smallInteger('weight')->nullable()->unsigned();
			$table->smallInteger('maximum_power')->nullable()->unsigned();
			$table->smallInteger('maximum_torque')->nullable()->unsigned();
			$table->string('emi_star_from', 100)->nullable();
			$table->tinyInteger('gear_box_id')->nullable()->unsigned()->index();
			$table->smallInteger('loan_upto')->nullable()->unsigned();
			$table->string('engine_check_warning')->nullable();
			$table->tinyInteger('wheel_base_id')->nullable()->unsigned()->index();
			$table->string('mild_hybrid', 100)->nullable();
			$table->tinyInteger('cylinder_id')->nullable()->unsigned()->index();
			$table->string('boot_space')->nullable();
			$table->string('front_suspension')->nullable();
			$table->tinyInteger('wheel_type_id')->nullable()->unsigned()->index();
			$table->smallInteger('wheel_size')->nullable()->unsigned();
			$table->smallInteger('turning_radius')->nullable()->unsigned();
			$table->tinyInteger('tyre_type_id')->nullable()->unsigned()->index();
			$table->smallInteger('front_tyre_size')->nullable()->unsigned();
			$table->smallInteger('rear_tyre_size')->nullable()->unsigned();
			$table->string('steering_type', 100)->nullable();
			$table->string('steering_gear_type', 100)->nullable();
			$table->tinyInteger('front_brake_id')->nullable()->unsigned()->index();
			$table->tinyInteger('rear_brake_id')->nullable()->unsigned()->index();
			$table->smallInteger('fuel_tank_capacity')->nullable()->unsigned();
			$table->smallInteger('milage')->nullable()->unsigned();
			$table->string('airbag', 100)->nullable();
			$table->string('wheel_base', 100)->nullable();
			$table->integer('finance_upto')->nullable()->unsigned();
			$table->float('auction_grade', 4, 2)->nullable()->unsigned();
			$table->tinyInteger('no_of_door')->nullable()->unsigned();
			$table->smallInteger('length')->nullable()->unsigned();
			$table->smallInteger('width')->nullable()->unsigned();
			$table->smallInteger('height')->nullable()->unsigned();
			$table->string('rear_suspension', 30)->nullable();
			$table->string('what_a_new', 50)->nullable();
			$table->string('pros_cons', 50)->nullable();
			$table->smallInteger('registration_cost')->nullable()->unsigned();
			$table->string('key_feature')->nullable();
			$table->string('interior_feature')->nullable();
			$table->string('exterior_feature')->nullable();
			$table->string('safety_security')->nullable();
			$table->string('additional_feature')->nullable();
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
        Schema::dropIfExists('cars');
    }
}
