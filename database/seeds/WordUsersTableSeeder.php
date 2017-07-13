<?php

use Illuminate\Database\Seeder;

class WordUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('word_users')->insert([
            ['id'=>1,'user_id'=>1,'word'=>'hello','type_word_id'=>1,'from_language_id'=>1,'to_language_id'=>2,'is_notification'=>1]
        ]);
    }
}
