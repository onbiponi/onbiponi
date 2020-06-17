<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_sliders', function (Blueprint $table) {
            $table->increments('id');
			$table->string('type', 30)->default('Car');
			$table->tinyInteger('number')->nullable()->default(3);
			$table->string('image1', 50)->nullable();
			$table->string('image2', 50)->nullable();
			$table->string('image3', 50)->nullable();
			$table->string('image4', 50)->nullable();
			$table->string('image5', 50)->nullable();
			$table->string('image6', 50)->nullable();
			$table->string('title', 191)->nullable();
			$table->string('description', 191)->nullable();
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
        Schema::dropIfExists('home_sliders');
    }
}
