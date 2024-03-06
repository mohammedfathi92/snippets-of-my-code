<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //templates
         Schema::create('print_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->unique();
            $table->longText('content')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });

         //do print actions

         Schema::create('print_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('module');
            $table->string('module_id');
             $table->integer('sanad_num')->nullable();
            $table->longText('content')->nullable();
            $table->integer('user_id')->unsigned()->nullable(); //who do action for
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_actions');
        Schema::dropIfExists('print_templates');
    }
}
