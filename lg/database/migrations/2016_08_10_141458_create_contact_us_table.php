<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("contacts",function (Blueprint $table){
            $table->increments("id");
            $table->string("subject");
            $table->text("message");
            $table->integer("parent");
            $table->boolean("opened")->default(0);
            $table->integer("user_id")->unsigned();
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
        Schema::drop("contacts");
    }
}
