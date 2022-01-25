<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifikasiArtworkDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasi_artwork_designs', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('status')->comment('0:Dikonfirmasi, 1: Direvisi, 2: Belum Ada Respon, 3:Belum ada tindakan sama sekali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verifikasi_artwork_designs');
    }
}
