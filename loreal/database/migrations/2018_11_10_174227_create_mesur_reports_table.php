<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesurReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesur_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string("leader_id")->nullable();
            $table->string("co_leader_id")->nullable();
            $table->string("copy_to_id")->nullable();
            $table->string("person_visited")->nullable();
            $table->unsignedInteger("visited_area_id")->nullable();
            $table->string("username")->nullable();
            $table->date("visited_date")->nullable();
            $table->string("visit_preparation")->nullable();
            $table->string("visit_topic")->nullable();
            $table->longText("observations")->nullable();
            $table->longText("actions")->nullable();
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
        Schema::dropIfExists('mesur_reports');
    }
}
