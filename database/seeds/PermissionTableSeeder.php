<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create banner', 'guard_name' => 'admin']);
        Permission::create(['name' => 'edit banner', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete banner', 'guard_name' => 'admin']);
    }
}
