<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("faq_categories", function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('icon_class')->nullable();
            $table->integer('sort')->default(1);
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("faq_category_translations", function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("description")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("category_id")->unsigned();
            $table->unique(['locale', 'category_id']);
            $table->foreign('category_id')->references("id")->on("faq_categories")->onDelete("cascade");
        });


        Schema::create("faq_questions", function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->integer('sort')->default(1);
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create("faq_question_translations", function (Blueprint $table) {
            $table->increments('id');
            $table->string("question");
            $table->text("answer")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("question_id")->unsigned();
            $table->unique(['locale', 'question_id']);
            $table->foreign('question_id')->references("id")->on("faq_questions")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("faq_question_translations");
        Schema::dropIfExists("faq_questions");
        Schema::dropIfExists("faq_category_translations");
        Schema::dropIfExists("faq_categories");
    }
}
