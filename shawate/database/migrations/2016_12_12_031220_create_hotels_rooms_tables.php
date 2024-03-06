<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsRoomsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Hotels Table
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('stars')->default(1);
            $table->float('price')->nullable();
            $table->float('offer_price')->nullable();
            $table->float('season_price')->nullable();
            $table->text('photo');
            $table->text('embed_video')->nullable();
            $table->boolean('in_home')->default(1);
            $table->boolean('in_country')->default(0);
            $table->string('address')->nullable();
            $table->string('map')->nullable();
            $table->unsignedInteger('country_id');
            $table->integer('city_id')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('hotel_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            $table->text("notes")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("hotel_id")->unsigned();
            $table->unique(['locale', 'hotel_id']);
            $table->foreign('hotel_id')->references("id")->on("hotels")->onDelete("cascade");
        });

        // Rooms Table
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hotel_id');
            $table->text('photo')->nullable();
            $table->text('embed_video')->nullable();
            $table->integer('persons')->default(1);
            $table->integer('beds')->default(1);
            $table->float('price')->nullable();
            $table->float('offer_price')->nullable();
            $table->float('season_price')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('hotel_id')->references("id")->on("hotels")->onDelete("cascade");
        });

        Schema::create('room_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            $table->text("notes")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("room_id")->unsigned();
            $table->unique(['locale', 'room_id']);
            $table->foreign('room_id')->references("id")->on("rooms")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("room_translations");
        Schema::dropIfExists("rooms");
        Schema::dropIfExists("hotel_translations");
        Schema::dropIfExists("hotels");
    }
}
