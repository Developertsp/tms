<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
<<<<<<< HEAD
            'view-companies',
            'create-companies',
            'update-companies',
            'delete-companies',
            
            'view-users',
            'create-users',
            'update-users',
            'delete-users',

            'view-roles',
            'create-roles',
            'update-roles',
            'delete-roles',

            'view-tasks',
            'create-tasks',
            'update-tasks',
            'delete-tasks',

            'view-projects',
            'create-projects',
            'update-projects',
            'delete-projects',
=======
            // 'view-users',
            // 'create-users',
            // 'update-users',
            // 'delete-users',
            
            // 'view-roles',
            // 'create-roles',
            // 'update-roles',
            // 'delete-roles',

            // 'view-tasks',
            // 'create-tasks',
            // 'update-tasks',
            // 'delete-tasks',

            // 'view-projects',
            // 'create-projects',
            // 'update-projects',
            // 'delete-projects',
>>>>>>> f822cf6 (updation in the)

            'view-departments',
            'create-departments',
            'update-departments',
            'delete-departments',
<<<<<<< HEAD

            'view-jd-tasks',
            'create-jd-tasks',
            'update-jd-tasks',
            'delete-jd-tasks',

        ];

=======
        ];
      
>>>>>>> f822cf6 (updation in the)
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
