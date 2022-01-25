<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 255);
            $table->string('email', 150);
            $table->string('company_name', 255);
            $table->string('mobile_phone', 13);
            $table->bigInteger('work_id')->index('work_id');
            $table->bigInteger('cities_id')->index('cities_id');
            $table->tinyInteger('is_verified')->nullable()->default(0);
            $table->datetime('verified_date')->nullable();
            $table->integer('latest_ordering')->nullable()->default(0);
            $table->text('address')->nullable();
            $table->tinyInteger('identity_id')->nullable();
            $table->text('photo')->nullable();
            $table->datetime('expire_token')->nullable();
            $table->text('token')->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
