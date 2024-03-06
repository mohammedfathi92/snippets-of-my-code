<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Countries Table
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('level')->default(3);
            $table->unsignedInteger('type_id');
            $table->float('price')->nullable();
            $table->float('offer_price')->nullable();
            $table->float('season_price')->nullable();
            $table->text('photo');
            $table->text('embed_video')->nullable();
            $table->integer('days');
            $table->integer('people_count')->default(1);
            $table->boolean('in_home')->default(1);
            $table->boolean('in_country')->default(1);
            $table->unsignedInteger('country_id');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('type_id')->references("id")->on("package_types")->onDelete("cascade");
            $table->foreign('country_id')->references("id")->on("countries")->onDelete("cascade");
        });

        Schema::create('package_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->nullable();
            $table->text("description")->nullable();
            $table->text("notes")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("package_id")->unsigned();
            $table->unique(['locale', 'package_id']);
            $table->foreign('package_id')->references("id")->on("packages")->onDelete("cascade");
        });

        Schema::create('packages_cities_hotels_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('hotel_id');
            $table->unsignedInteger('room_id');
            $table->integer('days');
            $table->foreign('package_id')->references("id")->on("packages")->onDelete("cascade");
            $table->foreign('city_id')->references("id")->on("cities")->onDelete("cascade");
            $table->foreign('hotel_id')->references("id")->on("hotels")->onDelete("cascade");
            $table->foreign('room_id')->references("id")->on("rooms")->onDelete("cascade");
        });

        Schema::create('packages_flights', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('from_country_id');
            $table->unsignedInteger('from_city_id');
            $table->unsignedInteger('to_country_id');
            $table->unsignedInteger('to_city_id');
            $table->unsignedInteger('flight_id');
            $table->foreign('package_id')->references("id")->on("packages")->onDelete("cascade");
            $table->foreign('from_country_id')->references("id")->on("countries")->onDelete("cascade");
            $table->foreign('from_city_id')->references("id")->on("cities")->onDelete("cascade");
            $table->foreign('to_country_id')->references("id")->on("countries")->onDelete("cascade");
            $table->foreign('to_city_id')->references("id")->on("cities")->onDelete("cascade");
            $table->foreign('flight_id')->references("id")->on("transports")->onDelete("cascade");
        });

        Schema::create('packages_transports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('transport_id');
            $table->unsignedInteger('city_id');

            $table->foreign('package_id')->references("id")->on("packages")->onDelete("cascade");
            $table->foreign('city_id')->references("id")->on("cities")->onDelete("cascade");
            $table->foreign('transport_id')->references("id")->on("transports")->onDelete("cascade");

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("packages_transports");
        Schema::dropIfExists("packages_flights");
        Schema::dropIfExists("packages_cities_hotels_rooms");
        Schema::dropIfExists("packages_rooms");
        Schema::dropIfExists("packages_hotels");
        Schema::dropIfExists("packages_cities");
        Schema::dropIfExists("package_translations");
        Schema::dropIfExists("packages");
    }
}
