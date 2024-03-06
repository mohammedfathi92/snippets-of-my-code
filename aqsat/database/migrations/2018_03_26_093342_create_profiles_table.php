<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name')->nullable();
            $table->string('formal_name')->nullable();
            $table->string('national_id')->nullable();
            $table->date('release_date')->nullable();
            $table->string('release_date_type')->default('mi'); //hij, milady
            $table->string('release_place')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('work')->nullable();
            $table->string('address')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('nationality')->nullable();
            $table->string('gender')->default('m'); //m => male, f => female, c => company
            $table->text('notes')->nullable();
            $table->integer('initial_balance')->nullable();
            $table->integer('user_id')->unsigned();
            $table->boolean('is_active')->default(true);
    

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
