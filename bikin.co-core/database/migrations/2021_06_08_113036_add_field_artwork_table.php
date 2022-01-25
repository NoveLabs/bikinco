<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldArtworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_item_artworks', function (Blueprint $table) {
            $table->string('width')->nullable()->after('preview_image');
            $table->string('height')->nullable()->after('preview_image');
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
            $table->dropColumn('width');
            $table->dropColumn('height');
        });
    }
}
