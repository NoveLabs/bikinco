<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlowStepFieldOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
                $table->tinyInteger('flow_step')->after('last_step_date')->nullable();
                $table->dateTime('flow_step_date')->after('last_step_date')->nullable();
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
                $table->dropColumn('flow_step');
                $table->dropColumn('flow_step_date');
        });
    }
}
