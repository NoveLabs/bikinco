<?php
    
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    
    class CustomerSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $content = [
                'fullname'      => 'Ananda Erditya Utama',
                'email'         => 'ananda@bikin.co',
                'company_name'  => 'Company A',
                'mobile_phone'  => '081234567890',
                'work_id'       => 2,
                'cities_id'     => 227,
                'is_verified'   => 1,
                'verified_date' => now(),
                'address'       => 'Street Name Here',
                'identity_id'   => 1,
                'photo'         => 'path/to/image.png',
                'expire_token'  => null,
                'created_at'    => now(),
                'updated_at'    => now(),
                'deleted_at'    => null,
            ];
            
            DB::table('customers')->insert($content);
        }
    }
