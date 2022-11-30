<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: RolesAndPermissionsSeeder.php
 * User: ${USER}
 * Date: 30.${MONTH_NAME_FULL}.2022
 * Time: 8:7
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'write']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'publish']);
        Permission::create(['name' => 'destroy']);

        $role = Role::create(['name' => 'silent_member']);
        $role->givePermissionTo('write');

        $role = Role::create(['name' => 'member']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'super_admin']);
        $role->givePermissionTo(Permission::all());
    }
}
