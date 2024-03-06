<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("testimonials", function (Blueprint $table) {

            $table->increments("id");
            $table->text("description")->nullable();
            $table->text("email")->nullable();
            $table->text("avatar")->nullable();
            $table->text("video_url")->nullable();
            $table->integer("trip_type")->default(1)->nullable();
            $table->enum("type", ['video', 'text'])->default("text");
            $table->unsignedInteger("country_id");
            $table->boolean("in_home")->default(false);
            $table->boolean("status")->default(false);
            $table->timestamps();
            $table->foreign("country_id")->references("id")->on("countries")->onDelete("cascade");

        });

        Schema::create('testimonial_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->nullable();
            $table->string("visitor_name")->nullable();
            $table->string("nationality")->nullable();
            $table->text("description")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("testimonial_id")->unsigned();
            $table->unique(['locale', 'testimonial_id']);
            $table->foreign('testimonial_id')->references("id")->on("testimonials")->onDelete("cascade");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("testimonial_translations");
        Schema::dropIfExists("testimonials");
    }
}
