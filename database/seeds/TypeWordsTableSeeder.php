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
            ['id'=>1,'name_type_word'=>'Danh từ'],
            ['id'=>2,'name_type_word'=>'Động từ'],
            ['id'=>3,'name_type_word'=>'Tính từ'],
            ['id'=>4,'name_type_word'=>'Trạng từ'],
            ['id'=>5,'name_type_word'=>'Thán từ'],
            ['id'=>6,'name_type_word'=>'Giới từ'],
            ['id'=>7,'name_type_word'=>'Phó từ'],
            ['id'=>8,'name_type_word'=>'Mạo từ'],
            ['id'=>9,'name_type_word'=>'Chưa xác định']
        ]);
    }
}
