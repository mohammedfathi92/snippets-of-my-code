<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("levels",function (Blueprint $table){
            $table->increments("id");
            $table->integer("parent_id");
            $table->text("photo")->nullable();
            $table->integer("target");
            $table->integer("min");
            $table->timestamps();
        });

        Schema::create("level_translations", function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->text("description")->nullable();
            $table->integer("level_id")->unsigned();
            $table->string("locale")->index();
            $table->unique(["level_id", "locale"]);
            $table->foreign("level_id")->references("id")->on("levels")->onDelete("cascade");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("level_translations");
        Schema::drop("levels");
    }
}
