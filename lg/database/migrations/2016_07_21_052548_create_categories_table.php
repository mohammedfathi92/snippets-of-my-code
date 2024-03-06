<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create("categories", function (Blueprint $table) {
            $table->increments("id");
            $table->text("photo")->nullable();
            $table->integer("created_by")->unsigned();
            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create("category_translations", function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->text("description")->nullable();
            $table->integer("category_id")->unsigned();
            $table->string("locale")->index();
            $table->unique(["category_id", "locale"]);
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop("category_translations");
        Schema::drop("categories");
    }
}
