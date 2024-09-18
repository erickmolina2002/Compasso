<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
       \App\Models\Role::create(['name' => 'User']);
       \App\Models\Role::create(['name' => 'Manager']);
       \App\Models\Role::create(['name' => 'Doctor']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\Role::where('name', 'User')->delete();
        \App\Models\Role::where('name', 'Manager')->delete();
        \App\Models\Role::where('name', 'Doctor')->delete();
    }
};
