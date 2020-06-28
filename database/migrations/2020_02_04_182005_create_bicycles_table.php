<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBicyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bicycles', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->tinyInteger('brand_id')->nullable()->unsigned()->index();
			$table->tinyInteger('model_id')->nullable()->unsigned()->index();
			$table->smallInteger('frame_size')->nullable()->unsigned();
			$table->string('frame_material', 100)->nullable();
			$table->string('suspension', 100)->nullable();
			$table->tinyInteger('gear_no')->nullable()->unsigned();
			$table->tinyInteger('wheel_type_id')->nullable()->unsigned()->index();
			$table->smallInteger('wheel_size')->nullable()->unsigned();
			$table->string('shifter')->nullable();
			$table->tinyInteger('made_origin_id')->nullable()->unsigned()->index();
			$table->smallInteger('weight')->nullable()->unsigned();
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
			$table->string('shifter_lever', 100)->nullable();
			$table->smallInteger('front_derailleur')->nullable()->unsigned()->index();
			$table->smallInteger('rear_derailleur')->nullable()->unsigned()->index();
			$table->string('rims', 100)->nullable();
			$table->string('hub_quality', 100)->nullable();
			$table->string('cassette', 100)->nullable();
			$table->smallInteger('recommended_biker_height')->nullable()->unsigned()->index();
			$table->tinyInteger('tyre_type_id')->nullable()->unsigned()->index();
			$table->smallInteger('tyre_size')->nullable()->unsigned();
			$table->string('crank', 100)->nullable();
			$table->string('seat_post', 100)->nullable();
			$table->string('chain', 100)->nullable();
			$table->string('pedal', 50)->nullable();
			$table->string('saddle', 50)->nullable();
			$table->string('headset', 100)->nullable();
			$table->string('handlebar', 100)->nullable();
			$table->string('grip', 100)->nullable();
			$table->string('stem', 100)->nullable();
			$table->string('brake_system', 100)->nullable();
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
        Schema::dropIfExists('bicycles');
    }
}
