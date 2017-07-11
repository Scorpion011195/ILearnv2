<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_words', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from_language_id',50);
            $table->string('to_language_id',50);
            $table->string('from_text',50);
            $table->string('to_text',50);
            $table->integer('quanlity');
            $table->string('type_word_id',50);
            $table->string('isAvailable',50);
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
        Schema::dropIfExists('statistic_words');
    }
}
