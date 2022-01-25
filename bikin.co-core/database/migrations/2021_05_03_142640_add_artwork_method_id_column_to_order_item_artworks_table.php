<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArtworkMethodIdColumnToOrderItemArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_item_artworks', function (Blueprint $table) {
            $table->tinyInteger('artwork_method_id')->nullable()->after('artwork_print_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_item_artworks', function (Blueprint $table) {
            $table->dropColumn('artwork_method_id');
        });
    }
}
