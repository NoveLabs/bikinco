<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LogOrderPaymentConfirmation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payment_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_payment_id')->unsigned();
            $table->string('proof_payment', 100);
            $table->dateTime('proof_payment_date', $precision = 0);
            $table->dateTime('due_date', $precision = 0);
            $table->tinyInteger('type')->default(4)->nullable()->comment = "1: FUll Payment, 2:DP";
            $table->string('status', 20)->comment = "1: Dikonfirmasi, 2: Ditolak, 3:Menunggu Konfirmasi";
            $table->string('is_dp', 20)->comment = "0: Lunas, 1: Setengah Pembayaran, 2:Pembayaran Pertama";
            $table->text('reason');
            $table->double('payment_total', 14, 2);
            $table->timestamps();
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
        //
    }
}
