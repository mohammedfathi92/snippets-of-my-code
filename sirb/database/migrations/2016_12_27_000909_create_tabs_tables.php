<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // News Table
        Schema::create('tabs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('photo')->nullable();
            $table->integer('module_id');
            $table->string("key", 50);
            $table->integer('sort')->default(1);
            $table->timestamps();
        });

        Schema::create('tab_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title");
            $table->longText("description");
            $table->string("locale", 3)->index();
            $table->integer("tab_id")->unsigned();
            $table->unique(['locale', 'tab_id']);
            $table->foreign('tab_id')->references("id")->on("tabs")->onDelete("cascade");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("tab_translations");
        Schema::dropIfExists("tabs");
    }
}
