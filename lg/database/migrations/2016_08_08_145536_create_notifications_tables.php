<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTables extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create("notifications", function (Blueprint $table) {
            $table->increments("id");
            $table->integer("from");
            $table->string("model")->nullable();
            $table->string("icon")->nullable();
            $table->text("url")->nullable();
            $table->text("message");
            $table->text("params")->nullable();
            $table->string("type")->default("info");
            $table->boolean("dismissed")->default(0);
            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create("users_notifications", function (Blueprint $table) {
            $table->increments("id");
            $table->integer("notification_id")->unsigned();
            $table->integer("user_id")->unsigned();
            $table->foreign("notification_id")->references("id")->on("notifications")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop("users_notifications");
        Schema::drop("notifications");
    }
}
