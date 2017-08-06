<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',32);
            $table->string('password',132);
            $table->string('email',100)->unique();
            $table->string('image',250)->default('user.png');
            $table->string('name',100)->nullable()->default(null);
            $table->string('address',150)->nullable()->default(null);
            $table->string('phone',50)->nullable()->default(null);
            $table->date('date_of_birth')->nullable()->default(null);
            $table->integer('status');
            $table->integer('number_of_use')->nullable()->default(null);
            $table->integer('role_id');
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
