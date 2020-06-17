<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
			$table->string('sku', 20)->nullable();
			$table->string('name', 100)->nullable();
			$table->text('description')->nullable();
			$table->bigInteger('supplier_id')->nullable()->unsigned()->index();
			$table->string('category_id')->nullable();
			$table->tinyInteger('quantity_per_unit')->default(1);
			$table->string('msrp')->nullable();
			$table->integer('size_id')->nullable()->unsigned()->index();
			$table->integer('color_id')->nullable()->unsigned()->index();
			$table->integer('discount')->unsigned()->default(0);
			$table->integer('weight')->nullable();
			$table->integer('stock')->default(0);
			$table->integer('unit_id')->nullable();
			$table->integer('unit_on_order')->default(0);
			$table->integer('reorder_level')->default(0);
			$table->tinyInteger('is_available')->default(1);
			$table->tinyInteger('discount_available')->default(0);
			$table->string('photo', 30)->nullable();
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
			$table->string('image11', 30)->nullable();
			$table->string('image12', 30)->nullable();
			$table->string('image13', 30)->nullable();
			$table->string('image14', 30)->nullable();
			$table->string('image15', 30)->nullable();
			$table->string('image16', 30)->nullable();
			$table->string('image17', 30)->nullable();
			$table->string('image18', 30)->nullable();
			$table->string('image19', 30)->nullable();
			$table->string('image20', 30)->nullable();
			$table->string('image21', 30)->nullable();
			$table->string('image22', 30)->nullable();
			$table->string('image23', 30)->nullable();
			$table->string('image24', 30)->nullable();
			$table->string('image25', 30)->nullable();
			$table->string('image26', 30)->nullable();
			$table->string('image27', 30)->nullable();
			$table->string('image28', 30)->nullable();
			$table->string('image29', 30)->nullable();
			$table->string('image30', 30)->nullable();
			$table->string('image31', 30)->nullable();
			$table->string('image32', 30)->nullable();
			$table->string('image33', 30)->nullable();
			$table->string('image34', 30)->nullable();
			$table->string('image35', 30)->nullable();
			$table->string('image36', 30)->nullable();
			$table->integer('ranking')->default(0);
			$table->tinyInteger('rating')->default(0);
			$table->text('note')->nullable();
			$table->integer('car_id')->nullable()->unsigned()->index();
			$table->integer('motorcycle_id')->nullable()->unsigned()->index();
			$table->integer('bicycle_id')->nullable()->unsigned()->index();
			$table->integer('condition_id')->nullable()->unsigned()->index();
			$table->integer('view')->default(0);
			$table->smallInteger('registration_year')->nullable()->unsigned();
			$table->smallInteger('kms_driven')->nullable()->unsigned();
			$table->string('after_sell_service', 50)->nullable();
			$table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('products');
    }
}
