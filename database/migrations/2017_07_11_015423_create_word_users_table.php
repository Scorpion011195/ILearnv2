<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('word_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('word',1000);
            $table->string('mean',1000);
            $table->string('type_word', 1000);
            $table->string('lang_pair_name', 100);
            $table->integer('from_language_id');
            $table->integer('to_language_id');
            $table->integer('is_notification');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('word_users');
    }
}
