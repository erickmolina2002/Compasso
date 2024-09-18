<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    public function up()
    {
        Permission::create(['name' => 'role.delete']);
        Permission::create(['name' => 'role.update']);
        Permission::create(['name' => 'role.create']);
        Permission::create(['name' => 'role.view']);

        Permission::create(['name' => 'permission.delete']);
        Permission::create(['name' => 'permission.update']);
        Permission::create(['name' => 'permission.create']);
        Permission::create(['name' => 'permission.view']);
        Role::firstOrCreate(['name' => 'Admin']);

    }
    public function down()
    {
        Role::where('name', 'admin')->delete();
        Permission::where('name', 'role.delete')->delete();
        Permission::where('name', 'role.update')->delete();
        Permission::where('name', 'role.create')->delete();
        Permission::where('name', 'role.view')->delete();

        Permission::where('name', 'permission.delete')->delete();
        Permission::where('name', 'permission.update')->delete();
        Permission::where('name', 'permission.create')->delete();
        Permission::where('name', 'permission.view')->delete();
    }
};
