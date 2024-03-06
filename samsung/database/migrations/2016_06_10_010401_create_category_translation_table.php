<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_translation', function(Blueprint $table){
            $table->increments('id');
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
        Schema::drop('category_translation');
    }
}
