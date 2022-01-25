<?php
    
    use Illuminate\Database\Seeder;
    
    class ClusterSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $content = [
                ['name' => 'Direktur', 'created_at' => now()],
                ['name' => 'PNS', 'created_at' => now()],
                ['name' => 'Karyawam', 'created_at' => now()],
            ];
            
            \Illuminate\Support\Facades\DB::table('customer_works')
                                          ->insert($content);
        }
    }
