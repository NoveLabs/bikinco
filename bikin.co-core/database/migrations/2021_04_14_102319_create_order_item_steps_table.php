<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_steps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_item_id')->unsigned();
            $table->text('step_title');
            $table->text('step_description');
            $table->tinyInteger('role')->length(4)->unsigned();
            // $table->tinyInteger('status', 4)->comment ='1: Dikerjakan, 2: Diproses QC, 3:Selesai';
            $table->tinyInteger('status')->length(4)->unsigned();
            $table->dateTime('due_date');
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
        Schema::dropIfExists('order_item_steps');
    }
}
