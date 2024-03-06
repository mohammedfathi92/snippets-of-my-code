<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookedHousingInfoTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        //booked_housings == housing that student is booked
        Schema::create("booked_housings", function (Blueprint $table) {
            $table->increments("id");
            $table->enum("type", ['family', 'student_house']);
            $table->integer("family_num")->nullable();
            $table->integer("beds_num")->nullable();
            $table->string("city_name")->nullable();
            $table->string("state")->nullable();
            $table->text("address_line1");
            $table->text("map")->nullable();
            $table->text("address_line2")->nullable();
            $table->string("phone_no1")->nullable();
            $table->string("phone_no2")->nullable();
            $table->string("phone_no3")->nullable();
            $table->string("email")->nullable();
            $table->date("check_in")->nullable();
            $table->date("check_out")->nullable();
            $table->string("photo")->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedInteger("country_id")->nullable();
            $table->unsignedInteger("city_id")->nullable(); // diabled

            $table->foreign("city_id")->references("id")->on("cities")->onDelete("cascade");
            $table->foreign("country_id")->references("id")->on("countries")->onDelete("cascade");

            $table->softDeletes();
            $table->timestamps();
            });


          Schema::create('booked_housing_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            
            $table->string("locale", 3)->index();
            $table->integer("booked_housing_id")->unsigned();
            $table->unique(['locale', 'booked_housing_id']);
            $table->foreign('booked_housing_id')->references("id")->on("booked_housings")->onDelete("cascade");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("booked_housings");
        Schema::dropIfExists("booked_housing_translations");

    }
}
