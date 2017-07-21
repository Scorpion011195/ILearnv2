<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['id'=>1,'username'=>'user01','password'=>bcrypt('user01'),'email'=>'user01@gmail.com','name'=>'Nguyễn Văn A','status'=>1,'role_id'=>5,'confirmed' =>1],
            ['id'=>2,'username'=>'superadmin','password'=>bcrypt('superadmin'),'email'=>'superadmin@gmail.com','name'=>'Nguyễn Văn B','status'=>1,'role_id'=>1,'confirmed' =>1],
            ['id'=>3,'username'=>'admin','password'=>bcrypt('admin'),'email'=>'admin@gmail.com','name'=>'Nguyễn Văn C','status'=>0,'role_id'=>2,'confirmed' =>1],
            ['id'=>4,'username'=>'editor','password'=>bcrypt('editor'),'email'=>'editor@gmail.com','name'=>'Nguyễn Văn D','status'=>1,'role_id'=>3,'confirmed' =>1],
            ['id'=>5,'username'=>'contributor','password'=>bcrypt('contributor'),'email'=>'contributor@gmail.com','name'=>'Nguyễn Văn E','status'=>1,'role_id'=>4,'confirmed' =>1]
        ]);
    }
}
