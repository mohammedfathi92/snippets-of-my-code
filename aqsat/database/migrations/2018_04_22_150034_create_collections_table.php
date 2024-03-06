<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contract_id')->nullable();
            $table->unsignedInteger('premium_id')->nullable();
            $table->date('premium_date')->nullable();
            $table->date('date_cancellation')->nullable();

            $table->unsignedInteger('client_id')->nullable();
            $table->integer('note_type')->default(1);  // [1 => client, 2 => kafil]
            $table->integer('call_with')->default(1);  // [1 => client, 2 => kafil]
            $table->dateTime('call_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_type')->nullable();
            $table->tinyInteger('call_status')->nullable();
            $table->longText('notes')->nullable();
            $table->boolean('is_active')->default(true);
        
            $table->timestamps();
            
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->foreign('premium_id')->references('id')->on('contract_premiums')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}
