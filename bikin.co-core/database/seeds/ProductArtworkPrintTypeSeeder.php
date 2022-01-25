<?php
    
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    
    class ProductArtworkPrintTypeSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $content = [
                [
                    'artwork_print_method_id' => 1,
                    'name'                    => 'Rubber Solid',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 1,
                    'name'                    => 'Rubber Raster',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 1,
                    'name'                    => 'Plastisol Solid',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 1,
                    'name'                    => 'Plastisol Raster',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 1,
                    'name'                    => 'Discharge Solid',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 2,
                    'name'                    => 'Transferpaper',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 2,
                    'name'                    => 'Polyflex',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 3,
                    'name'                    => 'Bordir Stick',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 1,
                    'name'                    => 'Rubber Solid',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 1,
                    'name'                    => 'Rubber Raster',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 1,
                    'name'                    => 'Plastisol Solid',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 1,
                    'name'                    => 'Plastisol Raster',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 1,
                    'name'                    => 'Discharge Solid',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 2,
                    'name'                    => 'Transferpaper',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 2,
                    'name'                    => 'Polyflex',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
                [
                    'artwork_print_method_id' => 3,
                    'name'                    => 'Bordir Stick',
                    'price'                   => 2000,
                    'description'             => 'test',
                    'status'                  => 1,
                    'created_at'              => now(),
                    'updated_at'              => null,
                    'deleted_at'              => null,
                ],
            ];
            DB::table('product_artwork_print_types')->insert($content);
        }
    }
