<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDictionarysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionarys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('word',50);
            $table->string('pronounce',50)->nullable()->default(null);
            $table->integer('type_word_id');
            $table->integer('language_id');
            $table->string('listen',150)->nullable()->default(null);
            $table->longtext('explain')->nullable()->default(null);
            $table->integer('mapping_id');
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
        Schema::dropIfExists('dictionarys');
    }
}
