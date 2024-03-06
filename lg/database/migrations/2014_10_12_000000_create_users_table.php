<?php

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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string("avatar")->nullable();
            $table->text("about")->nullable();
            $table->string("address")->nullable();
            $table->integer("phone");
            $table->integer("mobile");
            $table->string("company")->nullable();
            $table->string("job")->nullable();
            $table->string("annual_sales")->nullable();
            $table->string("language",3)->default("en");
            $table->integer("level");
            $table->integer("permission")->default(2);
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::drop('users');
    }
}
