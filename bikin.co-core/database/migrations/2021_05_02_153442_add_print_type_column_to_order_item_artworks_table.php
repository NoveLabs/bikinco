<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrintTypeColumnToOrderItemArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_item_artworks', function (Blueprint $table) {
            $table->tinyInteger('artwork_print_type_id')->nullable()->after('artwork_position');
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
            $table->dropColumn('artwork_print_type_id');
        });
    }
}
