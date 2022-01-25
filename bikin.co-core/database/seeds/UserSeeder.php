<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #jika sudah LIVE harap di comment coding ini
		if (Schema::hasTable('users')) {
	    	$users = array(
                [
                    'id'   => 1,
                    'name' => 'Super Admin',
                    'email' => 'superadmin@gmail.com',
                    'username'  => 'superadmin',
                    'password' => bcrypt('bikin.co'),
                ],
                [
                    'id'   => 2,
                    'name' => 'Sales Officer',
                    'email' => 'salesofficer@gmail.com',
                    'username'  => 'salesofficer',
                    'password' => bcrypt('bikin.co'),
                ],
                [
                    'id'   => 3,
                    'name' => 'Quality Control',
                    'email' => 'qualitycontrol@gmail.com',
                    'username'  => 'qualitycontrol',
                    'password' => bcrypt('bikin.co'),
                ],
                [
                    'id'   => 4,
                    'name' => 'Product Design',
                    'email' => 'productdesign@gmail.com',
                    'username'  => 'productdesign',
                    'password' => bcrypt('bikin.co'),
                ],
                [
                    'id'   => 5,
                    'name' => 'Accounting',
                    'email' => 'accounting@gmail.com',
                    'username'  => 'accounting',
                    'password' => bcrypt('bikin.co'),
                ],
                [
                    'id'   => 6,
                    'name' => 'Product Development',
                    'email' => 'productdevelopment@gmail.com',
                    'username'  => 'productdevelopment',
                    'password' => bcrypt('bikin.co'),
                ]
            );

	    	#truncate all row
	    	\DB::table('users')->delete();
	    	foreach($users as $user){
		    	#crete default data for sistem
		    	$cekDefaultUser = \DB::table('users')->where('name', $user['name'])->first();
	        	\DB::table('users')->insert([
                    'id'    => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'username'  => $user['username'],
                    'password' => $user['password'],
	        	]);
	    	}
        }

     
    }
}
