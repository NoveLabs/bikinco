<?php
    
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    
    class ProductArtworkPrintMethodSeeder extends Seeder
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
                    'product_id' => 1,
                    'name'       => 'Sablon Manual',
                    'status'     => 1,
                    'created_at' => now(),
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
                [
                    'product_id' => 1,
                    'name'       => 'Sablon Digital',
                    'status'     => 1,
                    'created_at' => now(),
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
                [
                    'product_id' => 1,
                    'name'       => 'Bordir Komputer',
                    'status'     => 1,
                    'created_at' => now(),
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
                [
                    'product_id' => 2,
                    'name'       => 'Sablon Manual',
                    'status'     => 1,
                    'created_at' => now(),
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
                [
                    'product_id' => 2,
                    'name'       => 'Sablon Digital',
                    'status'     => 1,
                    'created_at' => now(),
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
                [
                    'product_id' => 2,
                    'name'       => 'Bordir Komputer',
                    'status'     => 1,
                    'created_at' => now(),
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
            ];
            DB::table('product_artwork_print_methods')->insert($content);
        }
    }
