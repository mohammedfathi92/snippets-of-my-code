<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesFiltersTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("categories_filters_translations",function (Blueprint $table){
           $table->increments('id');
            $table->string('name');
            $table->integer('filter_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['filter_id', 'locale']);
            $table->foreign('filter_id')->references('id')->on('categories_filters')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories_filters_translations');
    }
}
