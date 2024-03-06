<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractPremiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_premiums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('call_status')->default(0);
            $table->dateTime('date_type_hij');
            $table->dateTime('date_type_mi');
            $table->decimal('amount',10,2)->default(0.00);
            $table->decimal('payment',10,2)->default(0.00);
             $table->decimal('commission',10,2)->default(0.00);
            $table->decimal('profit',10,2)->nullable();
            $table->tinyInteger('type')->default(1); //0 => lated, 1=> new
            $table->integer('order');
            $table->integer('account_id')->nullable();
            $table->text('note')->nullable();
             $table->dateTime('last_pay_time')->nullable();
            $table->timestamps();

             $table->boolean('is_active')->default(true);
            $table->softDeletes();
       

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_premia');
    }
}
