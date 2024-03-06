<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Categories Table
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string("type")->default('general'); //['courses', 'institutes' , 'general', ... ]
            $table->integer('parent_id')->unsigned()->nullable()->default(null);
            $table->foreign('parent_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
            $table->text('photo')->nullable();
            $table->boolean('in_home')->default(0);
            $table->boolean('status')->default(1);
            $table->string('color')->nullable();
            $table->timestamps();


        });


        Schema::create('category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("category_id")->unsigned();
            $table->unique(['locale', 'category_id']);
            $table->foreign('category_id')->references("id")->on("categories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("category_translations");
        Schema::dropIfExists("categories");
    }
}
