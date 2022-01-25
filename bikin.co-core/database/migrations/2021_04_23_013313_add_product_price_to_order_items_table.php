<?php
    
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    class AddProductPriceToOrderItemsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('order_items', function (Blueprint $table) {
                $table->decimal('product_price', 14, '2');
                $table->decimal('sum_size_price', 14, '2');
                $table->decimal('sum_accs_price', 14, '2');
                $table->decimal('sum_addon_price', 14, '2');
                $table->decimal('sum_adj_price', 14, '2');
                $table->decimal('sum_artworks_price', 14, '2');
                $table->decimal('sum_material_price', 14, '2');
            });
        }
        
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('order_items', function (Blueprint $table) {
                //
            });
        }
    }
