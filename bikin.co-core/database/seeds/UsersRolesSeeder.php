<?php

use Illuminate\Database\Seeder;

class UsersRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           #jika sudah LIVE harap di comment coding ini
		if (Schema::hasTable('users_roles')) {
	    	$users = array(
                [
                    'user_id' => 1,
                    'role_id' => 1,
                ],
                [
                    'user_id' => 2,
                    'role_id' => 2,
                ],
                [
                    'user_id' => 3,
                    'role_id' => 3,
                ],
                [
                    'user_id' => 4,
                    'role_id' => 4,
                ],
                [
                    'user_id' => 5,
                    'role_id' => 5,
                ],
                [
                    'user_id' => 6,
                    'role_id' => 6,
                ]
            );

	    	#truncate all row
	    	\DB::table('users_roles')->delete();
	    	foreach($users as $user){
		    	#crete default data for sistem
		    	$cekDefaultUser = \DB::table('users_roles')->where('user_id', $user['user_id'])->first();
	        	\DB::table('users_roles')->insert([
                    'user_id' => $user['user_id'],
                    'role_id' => $user['role_id']
	        	]);
	    	}
        }
    }
}
