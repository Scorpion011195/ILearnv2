<?php

use Illuminate\Database\Seeder;

class SettingUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting_users')->insert([
            ['id'=>1,'user_id'=>1,'time_reminder_id'=>1,'type_reminder_id'=>1,'isOn'=>'OFF'],
            ['id'=>2,'user_id'=>2,'time_reminder_id'=>1,'type_reminder_id'=>1,'isOn'=>'OFF'],
            ['id'=>3,'user_id'=>3,'time_reminder_id'=>1,'type_reminder_id'=>1,'isOn'=>'OFF'],
            ['id'=>4,'user_id'=>4,'time_reminder_id'=>1,'type_reminder_id'=>1,'isOn'=>'OFF'],
            ['id'=>5,'user_id'=>5,'time_reminder_id'=>1,'type_reminder_id'=>1,'isOn'=>'OFF']
        ]);
    }
}
