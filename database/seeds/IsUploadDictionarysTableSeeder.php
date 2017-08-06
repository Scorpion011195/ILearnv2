<?php

use Illuminate\Database\Seeder;

class IsUploadDictionarysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('is_upload_dictionarys')->insert([
            ['id'=>1, 'is_upload'=>0]
        ]);
    }
}
