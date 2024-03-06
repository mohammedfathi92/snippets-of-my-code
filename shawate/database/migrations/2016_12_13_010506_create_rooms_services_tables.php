<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsServicesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Hotels Services Table
        Schema::create('room_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icon_class')->nullable();
            $table->integer('sort')->default(1);
            $table->timestamps();
        });
        // Translation
        Schema::create('room_service_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("locale", 3)->index();
            $table->integer("room_service_id")->unsigned();
            $table->unique(['locale', 'room_service_id']);
            $table->foreign('room_service_id')->references("id")->on("room_services")->onDelete("cascade");
        });

        // this table for relations between hotels and it's services
        Schema::create('room_services_rooms', function (Blueprint $table) {
            $table->unsignedInteger("service_id");
            $table->unsignedInteger("room_id");
            $table->unique(['service_id', 'room_id']);
            $table->foreign('service_id')->references("id")->on("room_services")->onDelete("cascade");
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
        Schema::dropIfExists('room_services_rooms');
        Schema::dropIfExists('room_service_translations');
        Schema::dropIfExists('room_services');
    }
}
