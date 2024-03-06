<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //Incident reports

     Schema::create('incident_reports', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('type_loreal_site')->nullable();

            $table->unsignedInteger('reporter_id')->nullable();
            $table->string('injured_person_name')->nullable();
            $table->date('incident_date')->nullable();
            $table->string('time_between')->nullable();
            $table->string('incident_nature')->nullable();
            $table->string('incident_place')->nullable();
            $table->string('incident_type')->nullable();
            $table->string('injured_person_type')->nullable();
            $table->string('injured_person_position')->nullable();
            $table->integer('lost_days')->nullable();
            $table->integer('duty_days')->nullable();
            $table->text('circumstances')->nullable();
            $table->text('consequences')->nullable();
            $table->string('lesions_nature')->nullable();
            $table->string('lesions_location')->nullable();
            $table->string('causes_analysis')->nullable();
            $table->text('description_causes')->nullable();
            $table->text('actions_plans')->nullable();
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
        Schema::dropIfExists('incident_reports');
    }
}
