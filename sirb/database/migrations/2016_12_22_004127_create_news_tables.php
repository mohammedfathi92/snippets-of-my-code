<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // News Table
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->text('photo')->nullable();
            $table->boolean('in_home')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();

        });

        Schema::create('news_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("news_id")->unsigned();
            $table->unique(['locale', 'news_id']);
            $table->foreign('news_id')->references("id")->on("news")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("news_translations");
        Schema::dropIfExists("news");
    }
}
