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
            ['id'=>1,'words'=>'[{"type_word_id":1,"from_language_id":1,"to_language_id":3,"from_text":"hello","to_text":"xin ch\u00e0o","notification":"F"}]'],
            ['id'=>2,'words'=>'[{"type_word_id":1,"from_language_id":1,"to_language_id":3,"from_text":"hello","to_text":"xin ch\u00e0o","notification":"F"}]'],
            ['id'=>3,'words'=>'[{"type_word_id":1,"from_language_id":1,"to_language_id":3,"from_text":"hello","to_text":"xin ch\u00e0o","notification":"F"}]'],
            ['id'=>4,'words'=>'[{"type_word_id":1,"from_language_id":1,"to_language_id":3,"from_text":"hello","to_text":"xin ch\u00e0o","notification":"F"}]'],
            ['id'=>5,'words'=>'[{"type_word_id":1,"from_language_id":1,"to_language_id":3,"from_text":"hello","to_text":"xin ch\u00e0o","notification":"F"}]'],
        ]);
    }
}
