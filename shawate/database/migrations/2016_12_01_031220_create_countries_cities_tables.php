<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesCitiesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Countries Table
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('map')->nullable();
            $table->text('embed_video')->nullable();
            $table->text('flag')->nullable();
            $table->text('photo')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('country_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->longText("description")->nullable();
            $table->longText("guide")->nullable();
            $table->longText("notes")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("country_id")->unsigned();
            $table->unique(['locale', 'country_id']);
            $table->foreign('country_id')->references("id")->on("countries")->onDelete("cascade");
        });

        // Countries Table
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->text('photo')->nullable();
            $table->string('map')->nullable();
            $table->text('embed_video')->nullable();
            $table->unsignedInteger('country_id');
            $table->boolean('in_country')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('country_id')->references("id")->on("countries")->onDelete("cascade");
        });

        Schema::create('city_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("city_id")->unsigned();
            $table->unique(['locale', 'city_id']);
            $table->foreign('city_id')->references("id")->on("cities")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("city_translations");
        Schema::dropIfExists("cities");
        Schema::dropIfExists("country_translations");
        Schema::dropIfExists("countries");
    }
}
