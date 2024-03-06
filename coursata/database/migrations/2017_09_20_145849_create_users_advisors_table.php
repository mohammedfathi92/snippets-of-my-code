<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAdvisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("user_advisors", function (Blueprint $table) {

            $table->increments("id");
            $table->unsignedInteger("user_id")->nullable();
            $table->unsignedInteger("advisor_id")->nullable();
            $table->unsignedInteger("booking_id")->nullable();
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("advisor_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("booking_id")->references("id")->on("bookings")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("user_advisors");
    }
}
