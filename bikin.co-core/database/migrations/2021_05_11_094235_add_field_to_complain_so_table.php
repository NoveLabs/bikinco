<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToComplainSoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complain_so', function (Blueprint $table) {
            $table->bigInteger('order_id')->unsigned();
            $table->tinyInteger('complain_type');
            $table->text('notes');
            $table->text('attachment');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complain_so', function (Blueprint $table) {
            $table->dropColumn('order_id');
            $table->dropColumn('complain_type');
            $table->dropColumn('notes');
            $table->dropColumn('attachment');
        });
    }
}
