<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories',function(Blueprint $table){
            $table->increments("cat_id");
            $table->string("cat_slug")->unique();
            $table->string("cat_icon")->nullable();
            $table->string("cat_photo")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('categories_translation', function(Blueprint $table){
            
            $table->increments('cat_id');
            $table->integer('category_id')->unsigned();
            $table->string('cat_title');
            $table->text("cat_description")->nullable();
            $table->string('locale')->index();
            $table->unique(['category_id','locale']);
            $table->foreign('category_id')->references('cat_id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("categories");
        Schema::drop("categories_translations");
    }
}
