<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicInstituteServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Institutes basic services Table
        Schema::create('basic_services', function (Blueprint $table) {
            $table->increments('id');
            $table->text('photo')->nullable();
            $table->string('type');
            $table->float('price', 8, 4)->nullable();
            $table->float('fees', 8, 4)->nullable();
            $table->integer('sort')->default(1);
            $table->integer('min_age')->nullable(); // require with house type
            $table->string('house_type')->nullable();//['students', 'family']
            $table->softDeletes();
            $table->timestamps();
        });
        // Translation
        Schema::create('basic_service_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("meals")->nullable(); // require with house type
            $table->string("room_type")->nullable(); // require with house type
            $table->string("transport_type")->nullable();// require with transport type
            $table->text("description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("basic_service_id")->unsigned();
            $table->unique(['locale', 'basic_service_id']);
            $table->foreign('basic_service_id')->references("id")->on("basic_services")->onDelete("cascade");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basic_service_translations');
        Schema::dropIfExists('basic_services');
        
    }
}
