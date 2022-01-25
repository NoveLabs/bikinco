<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #jika sudah LIVE harap di comment coding ini
		if (Schema::hasTable('roles')) {
	    	$roles = array(
                    [
                        'id'   => 1,
                        'name' => 'Super Admin'
                    ],
                    [
                        'id'   => 2,
                        'name' => 'Sales Officer'
                    ],
                    [
                        'id'   => 3,
                        'name' => 'Quality Control'
                    ],
                    [
                        'id'   => 4,
                        'name' => 'Product Design'
                    ],
                    [
                        'id'   => 5,
                        'name' => 'Accounting'
                    ],
                    [
                        'id'   => 6,
                        'name' => 'Product Development'
                    ]
                );

	    	#truncate all row
	    	\DB::table('roles')->delete();
	    	foreach($roles as $role){
		    	#crete default data for sistem
		    	$cekDefaultRole = \DB::table('roles')->where('id', $role['id'])->first();
	        	\DB::table('roles')->insert([
                    'id'    => $role['id'],
					'name' => $role['name'],
	        	]);
	    	}
        }
        
    }
}
