<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutesCoursesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Institutes Table
        Schema::create('institutes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('photo');
            $table->text('logo')->nullable();
             $table->text('brochures')->nullable();
            $table->text('video_youtube')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('phone')->nullable();
            $table->integer('location_type')->default(1)->nullable();
            $table->string('map_address')->nullable(); //formatted_address
            $table->string('map_lat')->nullable();
            $table->string('map_lng')->nullable();
            $table->unsignedInteger('country_id');
            $table->integer('city_id')->nullable();
            $table->tinyInteger('locale_rate')->default(1);
            $table->tinyInteger('international_rate')->default(1);
            $table->boolean('in_home')->default(1);
            $table->boolean('featured')->default(false);
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('institute_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            $table->text("address")->nullable();
            $table->text('bank_account')->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("institute_id")->unsigned();
            $table->unique(['locale', 'institute_id']);
            $table->foreign('institute_id')->references("id")->on("institutes")->onDelete("cascade");
        });

        // Courses Table
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('institute_id');
            $table->text('photo')->nullable();
            $table->text('video_youtube')->nullable();
            $table->float('price')->nullable();
            $table->float('offer_price')->nullable();
            $table->integer('avg_students')->default(1);
            $table->integer('max_students')->default(1);
            $table->integer('num_students')->default(1);
            $table->integer('num_lessons')->default(1);
            $table->integer('duration')->default(1);
            $table->integer('min_age')->nullable();

            $table->string('start_day')->nullable();
            $table->string('start_date')->nullable();
            $table->integer('hours')->default(1);
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->tinyInteger('locale_rate')->default(1);
            $table->tinyInteger('international_rate')->default(1);
            $table->boolean('health_insurance')->default(true);
            $table->boolean('featured')->default(true);
            $table->boolean('in_home')->default(1);
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('institute_id')->references("id")->on("institutes")->onDelete("cascade");
            $table->foreign('category_id')->references("id")->on("categories")->onDelete("cascade");
            $table->foreign('currency_id')->references("id")->on("currencies")->onDelete("cascade");
        });

        Schema::create('course_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            $table->text("notes")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("course_id")->unsigned();
            $table->unique(['locale', 'course_id']);
            $table->foreign('course_id')->references("id")->on("courses")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("course_translations");
        Schema::dropIfExists("courses");
        Schema::dropIfExists("institute_translations");
        Schema::dropIfExists("institutes");
    }
}
