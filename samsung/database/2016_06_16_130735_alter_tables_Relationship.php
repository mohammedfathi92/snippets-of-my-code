<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablesRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // categories_properties Table
        Schema::table("categories_properties",function (Blueprint $table){
            
            $table->foreign('property_cat')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
        // categories_filters Table
        Schema::table("categories_filters",function (Blueprint $table){
//            $table->unique(['category']);
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });

        // products Table
        Schema::table("products",function (Blueprint $table){
//            $table->unique(['category']);
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
        // products_properties Table
        Schema::table("products_properties",function (Blueprint $table){
//            $table->unique(['product']);
            $table->foreign('product')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });

        // products_filters Table
        Schema::table("products_filters",function (Blueprint $table){
//            $table->unique(['product','filter']);
            $table->foreign('product')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('filter')->references('id')->on('categories_filters')->onDelete('cascade')->onUpdate('cascade');
        });
        // products_filters Table
        Schema::table("product_colors",function (Blueprint $table){
//            $table->unique(['product_id']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

        });

        // products_gallery Table
        Schema::table("product_gallery",function (Blueprint $table){
//            $table->unique(['product_id']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
