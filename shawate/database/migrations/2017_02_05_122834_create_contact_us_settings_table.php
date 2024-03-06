<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("contact_us_settings", function (Blueprint $table) {
            $table->increments("id");
            $table->string("geo_location")->nullable();
            $table->text("map_background")->nullable();
            $table->integer("auto_reply_user")->default(0);
            $table->boolean("show_mobile")->default(false);
            $table->boolean("mobile_required")->default(false);
            $table->boolean("country_required")->default(false);
            $table->boolean("show_country")->default(false);
        });
        Schema::create("contact_us_setting_translations", function (Blueprint $table) {
            $table->increments('id');
            $table->text("info")->nullable();
            $table->text("sent_success_message")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("setting_id")->unsigned();
            $table->unique(['locale', 'setting_id']);
            $table->foreign('setting_id')->references("id")->on("contact_us_settings")->onDelete("cascade");
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("contact_us_setting_translations");
        Schema::dropIfExists("contact_us_settings");
    }
}
