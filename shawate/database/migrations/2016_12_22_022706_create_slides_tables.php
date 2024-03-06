<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // News Table
        Schema::create('slides', function (Blueprint $table) {
            $table->increments('id');
            $table->text('photo')->nullable();
            $table->string('url')->default("#");
            $table->integer('sort')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('slide_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("locale", 3)->index();
            $table->integer("slide_id")->unsigned();
            $table->unique(['locale', 'slide_id']);
            $table->foreign('slide_id')->references("id")->on("slides")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("slide_translations");
        Schema::dropIfExists("slides");
    }
}
