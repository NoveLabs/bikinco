<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdjustOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('part_paid_amount')->default(0.00)->nullable()->after('payment_type');
            $table->unsignedInteger('total_item')->after('total_amount');
            $table->unsignedTinyInteger('last_step')->default(1)->after('order_date');
            $table->dateTime('last_step_date')->nullable()->after('last_step');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
