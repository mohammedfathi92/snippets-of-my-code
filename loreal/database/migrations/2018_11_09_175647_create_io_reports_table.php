<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIoReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('io_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string("io_type", 20)->default("sio");
            $table->unsignedInteger("issue_id")->nullable();
            $table->string("user_type")->default('employee');
            $table->unsignedInteger("reporter_id")->nullable();
            $table->string("reporter_name", 150)->nullable();
            $table->unsignedInteger("area_id")->nullable();
            $table->unsignedInteger("location_id")->nullable();
            $table->unsignedInteger("manager_id")->nullable();
            $table->text("description")->nullable();
            $table->text("suggestion")->nullable();
            $table->text("risks_list")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('io_reports');
    }
}
