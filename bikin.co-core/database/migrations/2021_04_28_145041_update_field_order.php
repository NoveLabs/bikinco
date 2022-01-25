<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE orders CHANGE COLUMN flow_step flow_step TINYINT(4) NULL DEFAULT '0' COMMENT '0. Order Created, 1.Confirmed By Customer, 3.Down Payment Paid, 4. Artwork Verification, 5. Production Done, 6. Ready Shipment, 7. Final Payment, 8. Final Payment Paid, 9. Shipment, 10. Order Arrived, 11. Complete Success, 12. in Complain' AFTER flow_step_date ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
