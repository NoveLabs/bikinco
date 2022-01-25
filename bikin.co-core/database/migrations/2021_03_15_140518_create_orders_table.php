<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->index('customer_id');
            $table->tinyInteger('payment_method');
            $table->tinyInteger('payment_type');
            $table->decimal('total_amount', 14, 2);
            $table->dateTime('order_date');
            $table->bigInteger('order_status_id')->index('order_status_id');
            $table->bigInteger('trx_status_id')->index('trx_status_id');
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
        Schema::dropIfExists('orders');
    }
}
