<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldOrderItemFinishedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_item_finished_photos', function (Blueprint $table) {
            $table->string('width')->nullable()->after('image');
            $table->string('height')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_item_finished_photos', function (Blueprint $table) {
            $table->dropColumn('width');
            $table->dropColumn('height');
        });    }
}
