<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Hotels Table
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->text('photo')->nullable();
            $table->text('embed_video')->nullable();
            $table->boolean('in_country')->default(1);
            $table->boolean('in_home')->default(1);
            $table->string('map')->nullable();
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('city_id');
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('country_id')->references("id")->on("countries")->onDelete("cascade");
            $table->foreign('city_id')->references("id")->on("cities")->onDelete("cascade");
        });

        Schema::create('place_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            $table->text("notes")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("place_id")->unsigned();
            $table->unique(['locale', 'place_id']);
            $table->foreign('place_id')->references("id")->on("places")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("place_translations");
        Schema::dropIfExists("places");
    }
}
