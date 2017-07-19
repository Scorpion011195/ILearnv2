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
            ['id'=>1,'name_type_word'=>'chưa xác định'],
            ['id'=>2,'name_type_word'=>'danh từ'],
            ['id'=>3,'name_type_word'=>'nội động từ'],
            ['id'=>4,'name_type_word'=>'ngoại động từ'],
            ['id'=>5,'name_type_word'=>'động từ'],
            ['id'=>6,'name_type_word'=>'tính từ'],
            ['id'=>7,'name_type_word'=>'trạng từ'],
            ['id'=>8,'name_type_word'=>'thán từ'],
            ['id'=>9,'name_type_word'=>'giới từ'],
            ['id'=>10,'name_type_word'=>'phó từ'],
            ['id'=>11,'name_type_word'=>'mạo từ'],
            ['id'=>12,'name_type_word'=>'liên từ'],
            ['id'=>13,'name_type_word'=>"danh từ,  số nhiều as,  a's'"],
            ['id'=>14,'name_type_word'=>'động từ had']
        ]);
    }
}
