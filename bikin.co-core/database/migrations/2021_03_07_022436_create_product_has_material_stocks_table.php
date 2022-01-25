<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductHasMaterialStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_material_stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->index('product_id');
            $table->bigInteger('material_stock_id')->index('material_stock_id');
            $table->unsignedInteger('qty')->default(0);
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
        Schema::dropIfExists('product_has_material_stocks');
    }
}
