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
            $table->string('word',1000);
            $table->string('pronounce',1000)->nullable()->default(null);
            $table->string('type_word', 1000);
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
