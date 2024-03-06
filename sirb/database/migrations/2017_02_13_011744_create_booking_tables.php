<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("bookings", function (Blueprint $table) {
            $table->increments("id");
            $table->string("name", 150);
            $table->string("email", 150);
            $table->string("nationality", 150);
            $table->string("mobile", 20);
            $table->date("arrival_date")->nullable();
            $table->date("departure_date")->nullable();
            $table->integer("num_rooms")->default(1);
            $table->integer("num_adults")->default(1);
            $table->integer("num_children")->default(0);
            $table->integer("num_bags")->default(0);
            $table->text("notes")->nullable();
            $table->integer("hotels_level")->nullable();
            $table->unsignedInteger("country_id")->nullable();
            $table->unsignedInteger("package_type_id")->nullable();
            $table->unsignedInteger("package_id")->nullable();
            $table->unsignedInteger("hotel_id")->nullable();
            $table->unsignedInteger("room_id")->nullable();
            $table->unsignedInteger("updated_by_id")->nullable();
            $table->enum("booking_type", ['free', 'package', 'hotel', 'room']);
            $table->tinyInteger("status")->default(1);// 1= pending, 2= confirmed, 3=closed, 4=canceled
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("country_id")->references("id")->on("countries")->onDelete("cascade");
            $table->foreign("package_type_id")->references("id")->on("package_types")->onDelete("cascade");
            $table->foreign("package_id")->references("id")->on("packages")->onDelete("cascade");
            $table->foreign("hotel_id")->references("id")->on("hotels")->onDelete("cascade");
            $table->foreign("room_id")->references("id")->on("rooms")->onDelete("cascade");
            $table->foreign("updated_by_id")->references("id")->on("users")->onDelete("cascade");
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("bookings");
    }
}
