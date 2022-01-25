<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMaterialStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_material_stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('supplier_id')->index('supplier_id');
            $table->bigInteger('material_item_id')->index('material_item_id');
            $table->unsignedInteger('initial_stock')->default(0);
            $table->unsignedInteger('hold_on_stock')->default(0);
            $table->bigInteger('unit_id')->index('unit_id');
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
        Schema::dropIfExists('product_material_stocks');
    }
}
