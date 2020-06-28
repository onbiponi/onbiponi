<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->nullable();
            $table->string('email', 100)->nullable();
			$table->string('phone', 30)->nullable();
			$table->string('billing_address')->nullable();
			$table->integer('billing_region_id')->unsigned()->index()->nullable();
			$table->integer('billing_division_id')->unsigned()->index()->nullable();
			$table->string('shipping_address')->nullable();
			$table->integer('shipping_region_id')->unsigned()->index()->nullable();
			$table->integer('shipping_division_id')->unsigned()->index()->nullable();
			$table->string('website', 50)->nullable();
			$table->text('about')->nullable();
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
        Schema::dropIfExists('guests');
    }
}
