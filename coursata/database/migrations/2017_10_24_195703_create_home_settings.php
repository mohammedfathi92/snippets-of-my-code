<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // News Table
        Schema::create('home_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('slide_type')->nullable();
            $table->text('slide_video')->nullable();
            $table->text('slide_gallery')->nullable();
            $table->text('steps_video_youtube')->nullable();
            $table->text('steps_video')->nullable(); 
            $table->text('steps_video_thumbnail')->nullable(); 
            $table->timestamps();

        });

        Schema::create('home_setting_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->text("usage_steps")->nullable();
            $table->text("footer_col_1")->nullable();
            $table->text("footer_col_2")->nullable();
            $table->text("footer_col_3")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("home_setting_id")->unsigned();
            $table->unique(['locale', 'home_setting_id']);
            $table->foreign('home_setting_id')->references("id")->on("home_settings")->onDelete("cascade");
        });

        // Artisan::call('db:seed',['--class'=>'HomeSettingsSeeder']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("home_setting_translations");
        Schema::dropIfExists("home_settings");
    }
}
