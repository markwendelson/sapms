<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = config('modules');
        // User
        Permission::create(['name' => 'view-user','module' => 'User']);
        Permission::create(['name' => 'create-user','module' => 'User']);
        Permission::create(['name' => 'edit-user','module' => 'User']);
        Permission::create(['name' => 'delete-user','module' => 'User']);


        // User
        Permission::create(['name' => 'view-item','module' => 'Item']);
        Permission::create(['name' => 'create-item','module' => 'Item']);
        Permission::create(['name' => 'edit-item','module' => 'Item']);
        Permission::create(['name' => 'delete-item','module' => 'Item']);

        \DB::table('permissions')->insertOrIgnore([
            ['column_name' => 'row1', 'column2_name' => 'row1'],
            ['column_name' => 'row2', 'column2_name' => 'row2']
        ]);



    }
}
