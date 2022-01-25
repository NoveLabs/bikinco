<?php
    
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    class CreateProductArtworkPrintTypesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('product_artwork_print_types',
                function (Blueprint $table) {
                    $table->increments('id');
                    $table->unsignedBigInteger('artwork_print_method_id');
                    $table->string('name');
                    $table->decimal('price', 14, 2);
                    $table->text('description')->nullable();
                    $table->tinyInteger('status')->default(1);
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
            Schema::dropIfExists('product_artwork_print_types');
        }
    }
