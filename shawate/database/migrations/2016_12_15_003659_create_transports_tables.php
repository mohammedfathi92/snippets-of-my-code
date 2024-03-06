<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Hotels Table
        Schema::create('transports', function (Blueprint $table) {
            $table->increments('id');
            $table->text('photo');
            $table->enum('type', ['flight', 'bus', 'car', 'ship']);
            $table->boolean('in_home')->default(1);
            $table->unsignedInteger('country_id');
            $table->integer('city_id')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('transport_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            $table->string("company_name")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("transport_id")->unsigned();
            $table->unique(['locale', 'transport_id']);
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
        Schema::dropIfExists("transport_translations");
        Schema::dropIfExists("transports");
    }
}
