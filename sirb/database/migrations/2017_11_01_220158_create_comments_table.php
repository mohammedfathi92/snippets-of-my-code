<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
        $table->increments('id');
        $table->string('creator_name')->nullable();
        $table->string('creator_email')->nullable();
        $table->integer('parent_id')->unsigned()->nullable()->default(null);
        $table->text('title')->nullable();
        $table->string('local')->default('ar'); //en - ar --- etc
        $table->text('content');
        $table->string('module'); //hotels - packages - cities ... etc
        $table->tinyInteger('module_id');
        $table->enum("creator_type", ['member', 'guest'])->default('guest');
        $table->boolean('status')->default(1);
        $table->unsignedInteger('member_id')->nullable();
        $table->unsignedInteger('guest_id')->nullable();
        $table->timestamps();

        $table->foreign('parent_id')->references('id')->on('comments')->onDelete("cascade");

        $table->foreign('member_id')->references("id")->on("users")->onDelete("cascade");
        $table->foreign('guest_id')->references("id")->on("guests")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("comments");
    }
}
