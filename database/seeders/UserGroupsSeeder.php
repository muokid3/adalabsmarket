<?php

namespace Database\Seeders;

use App\Models\UserGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_groups')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $userGroup = new UserGroup();
        $userGroup->name = 'SUPER ADMIN';
        $userGroup->save();

        $userGroup = new UserGroup();
        $userGroup->name = 'ADMIN';
        $userGroup->save();

        $userGroup = new UserGroup();
        $userGroup->name = 'CUSTOMER';
        $userGroup->save();
    }
}
