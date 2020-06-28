<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestedMoreInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_more_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name', 50)->nullable();
			$table->string('email', 50)->nullable();
			$table->string('phone', 25)->nullable();
			$table->text('message')->nullable();
			$table->bigInteger('product_id')->nullable()->unsigned()->index();
			$table->bigInteger('user_id')->nullable()->unsigned()->index();
			$table->timestamp('viewed_at')->nullable();
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
        Schema::dropIfExists('requested_more_infos');
    }
}
