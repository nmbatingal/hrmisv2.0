<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'can perform system admin task',
            ],
            [
                'name' => 'can perform unit head/chief tasks',
            ],
            [
                'name' => 'can perform regular staff tasks',
            ],
        ];

        $roles = [
            [
                'name' => 'System Administrator',
            ],
            [
                'name' => 'Unit Head',
            ],
            [
                'name' => 'Staff',
            ],
        ];

        foreach ($permissions as $i => $permission) {

            $permission = Permission::create($permission);
            Role::create($roles[$i])->givePermissionTo($permission);
            
        }
    }
}
