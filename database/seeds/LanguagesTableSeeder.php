<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            ['id'=>1,'name_language'=>'Anh','code_language'=>'en'],
            ['id'=>2,'name_language'=>'Nhật','code_language'=>'ja'],
            ['id'=>3,'name_language'=>'Việt','code_language'=>'vi']
        ]);
    }
}
