<?php

use Illuminate\Database\Seeder;

class RoleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->insert([
            ['id'=>1,'role'=>'superadmin'],
            ['id'=>2,'role'=>'admin'],
            ['id'=>3,'role'=>'editor'],
            ['id'=>4,'role'=>'contributor'],
            ['id'=>5,'role'=>'user'],
        ]);
    }
}
