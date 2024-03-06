<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("contact_messages", function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->string("email", 150);
            $table->string("mobile", 20)->nullable();
            $table->string("country", 150)->nullable();
            $table->string("subject")->nullable();
            $table->longText("message");
            $table->boolean("read")->default(false);
            $table->boolean("notified")->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("message_replies", function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("message_id");
            $table->unsignedInteger("user_id");
            $table->longText("message_text");
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("message_id")->references("id")->on("contact_messages")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("message_replies");
        Schema::dropIfExists("contact_messages");
    }
}
