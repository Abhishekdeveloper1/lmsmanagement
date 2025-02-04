<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Permission;

use Spatie\Permission\Models\Role;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Create roles
       $adminRole = Role::firstOrCreate(['name' => 'admin']);
       $userRole = Role::firstOrCreate(['name' => 'user']);

       // Create permissions
       $editPermission = Permission::firstOrCreate(['name' => 'edit articles']);
       $deletePermission = Permission::firstOrCreate(['name' => 'delete articles']);
       $viewPermission = Permission::firstOrCreate(['name' => 'view articles']);

       // Assign permissions to roles
       $adminRole->givePermissionTo([$editPermission, $deletePermission, $viewPermission]);
       $userRole->givePermissionTo($viewPermission);
    }
}
