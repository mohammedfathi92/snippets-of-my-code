<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('slug');
            $table->integer('level'); // user permission level . 0=>super admin , 1=>admin 2=> normal user
            $table->char('gender')->default("m");// "m" for male or "f" for female
            $table->string('lang')->default("ar"); # ar/en
            $table->string('avatar')->nullable();
            $table->string('about')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('gplus')->nullable();
            $table->string('instagram')->nullable();
            $table->enum('register_type', ['signup', 'facebook', 'linkedin', 'google'])->default('signup');
            $table->string('register_type_id')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        Artisan::call('db:seed', ['--class' => 'UsersSeeder']);


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
