<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutPageTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create("about", function (Blueprint $table) {
            $table->increments("id");
            $table->integer("updated_by");
            $table->timestamps();
        });

        Schema::create("about_translations", function (Blueprint $table) {
            $table->increments("id");
            $table->string("title");
            $table->longText("body")->nullable();
            $table->integer("about_id")->unsigned();
            $table->string("locale")->index();
            $table->unique(["about_id", "locale"]);
            $table->foreign("about_id")->references("id")->on("about")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop("about_translations");
        Schema::drop("about");
    }
}
