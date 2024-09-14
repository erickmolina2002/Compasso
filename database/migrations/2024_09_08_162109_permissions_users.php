<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
      public function up()
    {
        Permission::create(['name' => 'user.delete']);
        Permission::create(['name' => 'user.update']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.view']);
    }

    public function down()
    {
        Permission::where('name', 'user.delete')->delete();
        Permission::where('name', 'user.update')->delete();
        Permission::where('name', 'user.create')->delete();
        Permission::where('name', 'user.view')->delete();
    }
};
