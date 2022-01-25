<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldWidthHeightCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('width_fname')->nullable()->after('file_name');
            $table->string('width_icon')->nullable()->after('category_icon');
            $table->string('height_fname')->nullable()->after('file_name');
            $table->string('height_icon')->nullable()->after('category_icon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('width_fname');
            $table->dropColumn('width_icon');
            $table->dropColumn('height_fname');
            $table->dropColumn('height_icon');
        });
    }
}
