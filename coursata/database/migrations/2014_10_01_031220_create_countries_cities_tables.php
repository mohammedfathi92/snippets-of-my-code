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
            $table->string('code', '5')->unique();
            $table->unsignedInteger('region_id');
            $table->text('photo')->nullable();
            $table->text('flag')->nullable();
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('region_id')->references("id")->on("regions")->onDelete("cascade");

        });
        Schema::create('country_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
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
            $table->string('map_address')->nullable(); //formatted_address
            $table->string('map_lat')->nullable();
            $table->string('map_lng')->nullable();
            $table->text('photo')->nullable();
            $table->unsignedInteger('country_id');
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
        Schema::drop("city_translations");
        Schema::drop("cities");
        Schema::drop("country_translations");
        Schema::drop("countries");
    }
}
