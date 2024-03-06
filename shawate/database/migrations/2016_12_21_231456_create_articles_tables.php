<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Hotels Table
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->text('photo')->nullable();
            $table->boolean('in_home')->default(1);
            $table->unsignedInteger('category_id');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('category_id')->references("id")->on("categories")->onDelete("cascade");

        });

        Schema::create('article_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("article_id")->unsigned();
            $table->unique(['locale', 'article_id']);
            $table->foreign('article_id')->references("id")->on("articles")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("article_translations");
        Schema::dropIfExists("articles");
    }
}
