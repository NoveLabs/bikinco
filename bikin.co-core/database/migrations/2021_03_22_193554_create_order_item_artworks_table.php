<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_artworks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_item_id')->index('order_item_id');
            $table->bigInteger('artwork_size_id')->index('artwork_size_id');
            $table->bigInteger('artwork_position')->index('artwork_position');
            $table->bigInteger('material_specificiation_id')->index('material_specificiation_id');
            $table->unsignedInteger('color_qty');
            $table->decimal('amount', 14, 2);
            $table->text('preview_image')->nullable();
            $table->text('zip_file')->nullable();
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
        Schema::dropIfExists('order_item_artworks');
    }
}
