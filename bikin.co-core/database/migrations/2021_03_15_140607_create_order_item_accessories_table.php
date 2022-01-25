<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_accessories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_item_id')->index('order_item_id');
            $table->bigInteger('product_specification_id')->index('product_specification_id');
            $table->unsignedInteger('qty');
            $table->decimal('amount', 14, 2);
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
        Schema::dropIfExists('order_item_accessories');
    }
}
