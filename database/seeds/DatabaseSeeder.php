<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(RoleUsersTableSeeder::class);
        $this->call(SettingUsersTableSeeder::class);
        $this->call(StatisticWordsTableSeeder::class);
        $this->call(TimeRemindersTableSeeder::class);
        $this->call(TypeRemindersTableSeeder::class);
        $this->call(TypeWordsTableSeeder::class);
        $this->call(WordUsersTableSeeder::class);
        $this->call(IsUploadDictionarysTableSeeder::class);
    }
}
