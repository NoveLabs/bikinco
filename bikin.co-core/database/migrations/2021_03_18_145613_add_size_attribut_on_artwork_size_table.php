<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSizeAttributOnArtworkSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artwork_size', function (Blueprint $table) {
            $table->string('size', 255)->nullable()->change();
            $table->tinyInteger('is_custom')->default(0)->after('id');
            $table->unsignedTinyInteger('width')->nullable()->default(0)->after('size');
            $table->unsignedTinyInteger('height')->nullable()->default(0)->after('width');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artwork_size', function (Blueprint $table) {
            //
        });
    }
}
