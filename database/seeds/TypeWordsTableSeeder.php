<?php

use Illuminate\Database\Seeder;

class TypeWordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_words')->insert([
            ['id'=>1, 'language_id'=>3, 'name_type_word'=>'chưa xác định'],
            ['id'=>2, 'language_id'=>3, 'name_type_word'=>'danh từ'],
            ['id'=>3, 'language_id'=>3, 'name_type_word'=>'nội động từ'],
            ['id'=>4, 'language_id'=>3, 'name_type_word'=>'ngoại động từ'],
            ['id'=>5, 'language_id'=>3, 'name_type_word'=>'động từ'],
            ['id'=>6, 'language_id'=>3, 'name_type_word'=>'tính từ'],
            ['id'=>7, 'language_id'=>3, 'name_type_word'=>'trạng từ'],
            ['id'=>8, 'language_id'=>3, 'name_type_word'=>'thán từ'],
            ['id'=>9, 'language_id'=>3, 'name_type_word'=>'giới từ'],
            ['id'=>10, 'language_id'=>3, 'name_type_word'=>'phó từ'],
            ['id'=>11, 'language_id'=>3, 'name_type_word'=>'mạo từ'],
            ['id'=>12, 'language_id'=>3, 'name_type_word'=>'liên từ'],
            ['id'=>13, 'language_id'=>3, 'name_type_word'=>"danh từ,  số nhiều as,  a's'"],
            ['id'=>14, 'language_id'=>3, 'name_type_word'=>'động từ had'],
            ['id'=>15, 'language_id'=>1, 'name_type_word'=>'noun'],
            ['id'=>16, 'language_id'=>1, 'name_type_word'=>'verb'],
            ['id'=>17, 'language_id'=>1, 'name_type_word'=>'Pre'],
            ['id'=>18, 'language_id'=>1, 'name_type_word'=>'Conj'],
            ['id'=>19, 'language_id'=>1, 'name_type_word'=>'Inter']

        ]);
    }
}
