<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions

        Permission::create(['name' => 'edit appointment']);
        Permission::create(['name' => 'cancel appointment']);        
        Permission::create(['name' => 'make appointment']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'doctor']);
        $role->givePermissionTo(['edit appointment', 'cancel appointment']);

        $role = Role::create(['name' => 'patient']);
        $role->givePermissionTo('make appointment');        
    }
}
