<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_sizes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_item_id')->index('order_item_id');
            $table->bigInteger('size_id')->index('size_id');
            $table->bigInteger('size_type_id')->index('size_type_id');
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
        Schema::dropIfExists('order_item_sizes');
    }
}
