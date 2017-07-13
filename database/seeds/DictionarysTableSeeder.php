<?php

use Illuminate\Database\Seeder;

class DictionarysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dictionarys')->insert([
            ['id'=>1,'word'=>'hello','type_word_id'=>1,'language_id'=>1,'listen'=>'','explain'=>'','mapping_id'=>1],
            ['id'=>2,'word'=>'xin chào','type_word_id'=>1,'language_id'=>3,'listen'=>'','explain'=>'','mapping_id'=>1],
            ['id'=>3,'word'=>'こんにちは','type_word_id'=>1,'language_id'=>2,'listen'=>'','explain'=>'','mapping_id'=>1]
        ]);
    }
}
