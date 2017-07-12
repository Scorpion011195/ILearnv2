<?php

use Illuminate\Database\Seeder;

class TypeRemindersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_reminders')->insert([
            ['id'=>1,'type'=>'Từ'],
            ['id'=>2,'type'=>'Nghĩa'],
            ['id'=>3,'type'=>'Từ và nghĩa']
        ]);
    }
}
