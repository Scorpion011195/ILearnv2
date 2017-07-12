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
            ['id'=>1,'username'=>'user01','password'=>'user01','email'=>'user01@gmail.com','name'=>'Nguyễn Văn A','status'=>'Hoạt động','role_id'=>5,'word_id'=>1,'setting_id'=>1],
            ['id'=>2,'username'=>'superadmin','password'=>'superadmin','email'=>'superadmin@gmail.com','name'=>'Nguyễn Văn B','status'=>'Hoạt động','role_id'=>1,'word_id'=>2,'setting_id'=>2],
            ['id'=>3,'username'=>'admin','password'=>'admin','email'=>'admin@gmail.com','name'=>'Nguyễn Văn C','status'=>'Bị khóa','role_id'=>2,'word_id'=>3,'setting_id'=>3],
            ['id'=>4,'username'=>'editor','password'=>'editor','email'=>'editor@gmail.com','name'=>'Nguyễn Văn D','status'=>'Hoạt động','role_id'=>3,'word_id'=>4,'setting_id'=>4],
            ['id'=>5,'username'=>'contributor','password'=>'contributor','email'=>'contributor@gmail.com','name'=>'Nguyễn Văn E','status'=>'Hoạt động','role_id'=>4,'word_id'=>5,'setting_id'=>5],
        ]);
    }
}
