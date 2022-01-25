<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldIsPriorityToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger('is_priority')->after('trx_status_id')->nullable();
            $table->decimal('shipment_amount',14,2)->after('total_item')->nullable();
            $table->decimal('total_price_rounding',14,2)->after('shipment_amount')->nullable();
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
            $table->dropColumn([
                'is_priority',
                'shipment_amount',
                'total_price_rounding',
            ]);
        });
    }
}
