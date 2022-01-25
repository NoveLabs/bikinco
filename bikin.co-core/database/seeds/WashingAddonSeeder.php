<?php
    
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    
    class WashingAddonSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $content = [
                ['name'            => 'Denim',
                 'status'          => 1,
                 'is_has_material' => 0,
                 'price'           => 2000,
                 'description'     => 'Washing Denim',
                 'slug_name'       => 'washing',
                ],
                ['name'            => 'Standard',
                 'status'          => 1,
                 'is_has_material' => 0,
                 'price'           => 2000,
                 'description'     => 'Washing Standard',
                 'slug_name'       => 'washing',
                ],
            ];
            
            DB::table('product_addons')->insert($content);
        }
    }
