<?php

namespace Modules\Components\LMS\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChatTables extends Migration
{
    protected $module_prefix = "chat_";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->module_prefix . 'conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_one');
            $table->unsignedInteger('user_two');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('user_one')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_two')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create($this->module_prefix . 'messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message')->nullable();
            $table->text('media_url')->nullable();
            $table->string('type')->nullable()->default('text'); //text, audio, question
            $table->boolean('is_seen')->default(false);
            $table->boolean('deleted_from_sender')->default(false);
            $table->boolean('deleted_from_receiver')->default(false);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('conversation_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('conversation_id')->references('id')->on($this->module_prefix . 'conversations')->onDelete('cascade');

        });


        Schema::create($this->module_prefix . 'attachments', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('message_id');
            $table->string('source', 100);
            $table->string('name', 150);
            $table->string('mime_type', 50)->nullable();
            $table->foreign('message_id')->references('id')->on($this->module_prefix . 'messages')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->module_prefix . 'attachments');
        Schema::dropIfExists($this->module_prefix . 'messages');
        Schema::dropIfExists($this->module_prefix . 'conversations');
    }
}
