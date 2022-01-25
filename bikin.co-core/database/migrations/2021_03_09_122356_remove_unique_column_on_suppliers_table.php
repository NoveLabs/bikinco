<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUniqueColumnOnSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropUnique(['pic_name']);
            $table->dropUnique(['pic_phone_number']);
            $table->dropUnique(['company_name']);
            $table->dropUnique(['company_contact']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropUnique(['pic_name']);
            $table->dropUnique(['pic_phone_number']);
            $table->dropUnique(['company_name']);
            $table->dropUnique(['company_contact']);
        });
    }
}
