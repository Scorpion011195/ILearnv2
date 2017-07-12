<?php

use Illuminate\Database\Seeder;

class TimeRemindersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('time_reminders')->insert([
            ['id'=>1,'time'=>5],
            ['id'=>2,'time'=>10],
            ['id'=>3,'time'=>15],
            ['id'=>4,'time'=>30],
            ['id'=>5,'time'=>60]
        ]);
    }
}
