<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user = new User();
        $user->user_group = 1; //super admin
        $user->name = "Adamarket Admin";
        $user->email = "adamarket@adalabs.com";
        $user->password = bcrypt("adalabs2022");
        $user->save();


    }
}
