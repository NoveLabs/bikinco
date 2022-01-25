<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldStatusOrderShipments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_shipments', function (Blueprint $table) {
            $table->tinyInteger('status')->nullable()->after('no_resi')->default('1')->comment = '0. Selesai Input Resi, 1. Menunggu Input Berat oleh QC , 2.SO input Ekspedisi & Harga';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_shipments', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
