<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutesServicesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Institutes Services Table
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->text('photo')->nullable();
            $table->float('price', 8, 4)->nullable();
            $table->float('fees', 8, 4)->nullable();
            $table->integer('sort')->default(1);
            $table->integer('min_age')->nullable(); // require with house type
            $table->string('type', ['house', 'transport', 'insurance', 'adviser'])->nullable();
            $table->string('house_type')->nullable();//['students', 'family']
            $table->unsignedInteger('institute_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('institute_id')->references("id")->on("institutes")->onDelete("cascade");
        });
        // Translation
        Schema::create('service_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("meals")->nullable(); // require with house type
            $table->string("room_type")->nullable(); // require with house type
            $table->string("transport_type")->nullable();// require with transport type
            $table->text("description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("service_id")->unsigned();
            $table->unique(['locale', 'service_id']);
            $table->foreign('service_id')->references("id")->on("services")->onDelete("cascade");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_translations');
        Schema::dropIfExists('services');
        
    }
}
