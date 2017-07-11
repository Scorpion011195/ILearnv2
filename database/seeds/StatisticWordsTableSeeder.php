<?php

use Illuminate\Database\Seeder;

class StatisticWordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statistic_words')->insert([
            ['id'=>1,'from_language_id'=>1,'to_language_id'=>2,'from_text'=>'hello','to_text'=>'xin chào','quanlity'=>0,'type_word_id'=>1,'isAvailable'=>'YES']
        ]);
    }
}
