<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permission = new Permission(); //1
        $permission->name = 'View Dashboard';
        $permission->save();

        $permission = new Permission(); //2
        $permission->name = 'Manage product categories';
        $permission->save();

        $permission = new Permission(); //3
        $permission->name = 'Manage products';
        $permission->save();

        $permission = new Permission(); //4
        $permission->name = 'Manage Users';
        $permission->save();

    }
}
