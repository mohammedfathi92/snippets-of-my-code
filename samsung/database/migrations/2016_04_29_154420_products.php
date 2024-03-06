<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        //
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('category')->unsigned();
            $table->integer('user')->unsigned();
            $table->string('photo')->nullable();
            $table->tinyInteger('show_in_home')->default(0);
            $table->text('slide_description')->nullable();
            $table->string('slide_photo')->nullable();
            $table->string('slide_background')->nullable();
            $table->integer('sort');
            $table->softDeletes();
            $table->timestamps();
        });
        
        
       
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
