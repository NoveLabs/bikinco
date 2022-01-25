<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSpecificationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_specification_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_specification_id')->index('product_specification_id');
            $table->string('name', 255)->unique();
            $table->tinyInteger('status')->default(1);
            $table->decimal('price', 14, 2);
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
        Schema::dropIfExists('product_specification_items');
    }
}
