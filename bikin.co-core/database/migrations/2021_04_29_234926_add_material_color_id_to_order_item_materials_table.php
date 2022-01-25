<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaterialColorIdToOrderItemMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_item_materials', function (Blueprint $table) {
            $table->tinyInteger('material_color_id')->nullable()->after('material_specification_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_item_materials', function (Blueprint $table) {
            $table->dropColumn('material_color_id');
        });
    }
}
