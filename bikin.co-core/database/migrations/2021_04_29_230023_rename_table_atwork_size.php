<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTableAtworkSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("RENAME TABLE `product_artwork_print_methods` TO `artwork_print_methods`");
        \DB::statement("RENAME TABLE `product_artwork_print_types` TO `artwork_print_types`");
        \DB::statement("ALTER TABLE `artwork_print_methods` DROP COLUMN `product_id`");
        \DB::statement("ALTER TABLE `artwork_print_types`DROP COLUMN `artwork_print_method_id`");
        \DB::statement("ALTER TABLE `artwork_size` DROP COLUMN `artwork_id`");
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
