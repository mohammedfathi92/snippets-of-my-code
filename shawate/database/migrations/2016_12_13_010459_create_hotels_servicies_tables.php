<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsServiciesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Hotels Services Table
        Schema::create('hotel_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icon_class')->nullable();
            $table->integer('sort')->default(1);
            $table->timestamps();
        });
        // Translation
        Schema::create('hotel_service_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("locale", 3)->index();
            $table->integer("hotel_service_id")->unsigned();
            $table->unique(['locale', 'hotel_service_id']);
            $table->foreign('hotel_service_id')->references("id")->on("hotel_services")->onDelete("cascade");
        });

        // this table for relations between hotels and it's services
        Schema::create('hotel_services_hotels', function (Blueprint $table) {
            $table->unsignedInteger("service_id");
            $table->unsignedInteger("hotel_id");
            $table->unique(['service_id', 'hotel_id']);

            $table->foreign('service_id')->references("id")->on("hotel_services")->onDelete("cascade");
            $table->foreign('hotel_id')->references("id")->on("hotels")->onDelete("cascade");

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_services_hotels');
        Schema::dropIfExists('hotel_service_translations');
        Schema::dropIfExists('hotel_services');
    }
}
