<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('guests', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('email')->nullable();
        $table->text('phone')->nullable();
        $table->string('ip_address')->nullable();
        $table->string('address')->nullable();
        $table->string('city')->nullable();
        $table->boolean('status')->default(1);
        $table->unsignedInteger('country_id')->nullable();
        $table->timestamps();
        $table->foreign('country_id')->references("id")->on("countries")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("guests");
    }
}
