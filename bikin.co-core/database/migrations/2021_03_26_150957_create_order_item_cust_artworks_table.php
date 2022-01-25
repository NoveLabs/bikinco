<?php
    
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    class CreateOrderItemCustArtworksTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('order_item_cust_artworks',
                function (Blueprint $table) {
                    $table->id();
                    $table->bigInteger('order_item_id')->index('order_item_id');
                    $table->string('title');
                    $table->text('photo')->nullable();
                    $table->timestamps();
                    $table->softDeletes($column = 'deleted_at', $precision = 0);
                });
        }
        
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('order_item_cust_artworks');
        }
    }
