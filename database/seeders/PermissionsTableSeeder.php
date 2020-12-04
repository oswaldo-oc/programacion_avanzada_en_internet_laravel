<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$admin = Role::create(['name' => 'Admin']);
        $user = Role::create(['name' => 'User']);

        //categories
        Permission::create(['name' => 'crud categories']);

        //books
        Permission::create(['name' => 'view books']);
        Permission::create(['name' => 'add books']);
        Permission::create(['name' => 'update books']);
        Permission::create(['name' => 'delete books']);

        //users
        Permission::create(['name' => 'crud users']);

        //loans
        Permission::create(['name' => 'view loans']);
        Permission::create(['name' => 'add loans']);
        Permission::create(['name' => 'update loans']);
        Permission::create(['name' => 'delete loans']);

        $admin->givePermissionTo([
        	'crud categories',

			'view books',
			'add books',
			'update books',
			'delete books',
			
			'crud users',
			
			'view loans',
			'add loans',
			'update loans',
			'delete loans'
        ]);

        $user->givePermissionTo([
        	'view books',

        	'view loans',
			'add loans',
			'update loans'
        ]);

        $users = User::all();
        foreach ($users as $user) {
        	if ($user->role_id!=null) {
        		$user->assignRole($user->role_id);
        	}
        }
    }
}
