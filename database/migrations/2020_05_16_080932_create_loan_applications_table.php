<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name', 50)->nullable();
			$table->string('email', 50)->nullable();
			$table->string('phone', 30)->nullable();
			$table->integer('amount')->default(0)->nullable();
			$table->smallInteger('condition_id')->default(0)->unsigned()->index()->nullable();
			$table->integer('dependant')->default(0)->nullable();
			$table->timestamp('dob')->nullable();
			$table->string('marital_status', 30)->nullable();
			$table->string('city', 30)->nullable();
			$table->string('address', 50)->nullable();
			$table->string('house_number', 50)->nullable();
			$table->integer('monthly_income')->nullable();
			$table->string('gender', 50)->nullable();
			$table->string('employment_industry', 50)->nullable();
			$table->string('employment_name', 50)->nullable();
			$table->string('work_phone', 50)->nullable();
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
        Schema::dropIfExists('loan_applications');
    }
}
