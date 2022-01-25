<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaterialItemIdToMaterialSpecificationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('material_specification_items', function (Blueprint $table) {
            $table->tinyInteger('material_item_id')->nullable()->after('material_specification_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('material_specification_items', function (Blueprint $table) {
            $table->dropColumn('material_item_id');
        });
    }
}
