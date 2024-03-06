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
           
            $table->string("payment_method");

            $table->string("payer_email")->nullable();
            $table->string("card_number")->nullable();
            $table->string("payer_id")->nullable();
            $table->string("payment_id")->nullable();

            $table->string("booking_code")->nullable();
            
            
            $table->string("communication_source");
           
            $table->integer("total_price");
            $table->integer("course_week_price");
            $table->integer("course_total_price");
            $table->integer("course_weeks");
            $table->integer("currency")->nullable();
            $table->string("passport_photo")->nullable();
            $table->date("arrival_date")->nullable();
            $table->date("departure_date")->nullable();
            $table->integer("num_courses")->default(1);
            $table->text("notes")->nullable(); //Notes of client
            $table->text("admin_notes")->nullable(); //Notes of Administration
            $table->text("message")->nullable(); //admin msg to client
            $table->integer("institutes_level")->nullable();
            
            $table->unsignedInteger("user_id")->nullable();
            $table->unsignedInteger("housing_id")->nullable();
            $table->unsignedInteger("advisor_id")->nullable();
            $table->unsignedInteger("institute_id")->nullable();
            $table->unsignedInteger("course_id")->nullable();
            $table->unsignedInteger("updated_by_id")->nullable();
            $table->string("booking_type")->nullable();
            $table->string("issue_type")->nullable(); 
            $table->text("issue_description")->nullable();
            $table->tinyInteger("status")->default(1); // 1= pending, 2= confirmed, 3=closed, 4=canceled
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("housing_id")->references("id")->on("booked_housings")->onDelete("cascade");
            
            $table->foreign("institute_id")->references("id")->on("institutes")->onDelete("cascade");
            $table->foreign("course_id")->references("id")->on("courses")->onDelete("cascade");
            $table->foreign("updated_by_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("advisor_id")->references("id")->on("users")->onDelete("cascade");
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
