<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
<<<<<<< HEAD
            'name'      => 'Software Manager',
            'email'     => 'softwaremanager@gmail.com',
            'password'  => Hash::make('12345678'),
            'scope'     => 1,
            'created_by'  => 1,
        ]);

        $role = Role::create(['name' => 'software_manager']);
        $permissions = Permission::orderBy('id')->pluck('id', 'id')->all();

        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        // Get all permissions except the first four
        $permissions = array_slice($permissions, 4);
        $superAdminRole = Role::create(['name' => 'super_admin']);
        $superAdminRole->syncPermissions($permissions);
=======
            'name'      => 'Super Admin',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('12345678'),
            'created_by'  => 1,
        ]);

        $role = Role::create(['name' => 'Super Admin']);
        $permissions = Permission::pluck('id','id')->all();
        
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
>>>>>>> f822cf6 (updation in the)
    }
}
