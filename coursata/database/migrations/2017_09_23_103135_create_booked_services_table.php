<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookedServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("booked_services", function (Blueprint $table) {

            $table->increments("id");
             $table->unsignedInteger("service_id")->nullable();
            $table->string("type");
            $table->string("name");
            $table->string("house_type")->nullable();
            $table->integer("week_price")->nullable();
            $table->integer("total_price")->nullable();
            $table->integer("num_weeks")->nullable();
            $table->unsignedInteger("booking_id")->nullable();
            $table->unsignedInteger("user_id")->nullable();
            $table->tinyInteger("status")->default(1);
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("booking_id")->references("id")->on("bookings")->onDelete("cascade");
            $table->foreign("service_id")->references("id")->on("services")->onDelete("cascade");
            

             });

         }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("booked_services");
    }
}
