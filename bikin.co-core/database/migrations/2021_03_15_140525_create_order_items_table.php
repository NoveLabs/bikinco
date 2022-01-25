<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->index('order_id');
            $table->bigInteger('product_id')->index('product_id');
            $table->bigInteger('sizepack_id')->index('sizepack_id');
            $table->tinyInteger('priority')->default(0);
            $table->tinyInteger('cust_to_own_type');
            $table->tinyInteger('own_to_cust_type');
            $table->tinyInteger('is_custom_label')->default(0);
            $table->text('label_photo')->nullable();
            $table->tinyInteger('is_repackaging')->default(0);
            $table->text('packaging_note')->nullable();
            $table->text('packaging_photo')->nullable();
            $table->tinyInteger('is_washing')->default(0);
            $table->tinyInteger('washing_type');
            $table->tinyInteger('is_has_design')->default(0);
            $table->text('design_photo')->nullable();
            $table->tinyInteger('is_has_references')->default(0);
            $table->text('references_note')->nullable();
            $table->text('references_photo')->nullable();
            $table->dateTime('order_date');
            $table->dateTime('completed_date');
            $table->bigInteger('vendor_id')->index('vendor_id');
            $table->dateTime('vendor_mou_date');
            $table->dateTime('vendor_mou_completed_date');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('order_items');
    }
}
