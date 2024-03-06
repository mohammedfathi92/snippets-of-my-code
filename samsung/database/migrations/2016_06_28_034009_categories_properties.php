<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoriesProperties extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create("categories_properties", function (Blueprint $table) {
            $table->increments("id");
            $table->string("icon");
            $table->string("icon_size")->default(32)->nullable();
            $table->integer("sort")->default(0)->nullable();
            $table->integer("category_id")->unsigned();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop("categories_properties");
    }
}
