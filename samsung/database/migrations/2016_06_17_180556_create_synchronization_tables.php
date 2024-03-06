<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSynchronizationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create update_out table
        // this table for online only
        Schema::table("update_out",function (Blueprint $table){
            $table->dropIfExists();
            $table->create();
            $table->bigIncrements('id');
            $table->string('table_name');
            $table->enum('action',['create','update','delete']);
            $table->integer('action_id');
            $table->text('query')->nullable();
            $table->timestamp('created_at');
        });

        // create Update_in table
        //this table for local only
        Schema::table("update_in",function (Blueprint $table){
            $table->dropIfExists();
            $table->create();
            $table->bigIncrements('id');
            $table->integer('update_id');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("update_out");
        Schema::drop("update_in");

    }
}
