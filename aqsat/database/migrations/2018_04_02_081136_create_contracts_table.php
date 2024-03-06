<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contract_num')->unique();
            $table->integer('investor_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('sponsor_id')->nullable();
            $table->tinyInteger('contract_type')->nullable();

            $table->integer('sponsor_two_id')->nullable();
            $table->integer('group_id')->unsigned()->nullable();
           
            $table->dateTime('contract_date')->nullable();
            $table->integer('premiums_date_type')->nullable();
            $table->tinyInteger('schedule_type')->nullable();
            $table->date('premiums_start_date')->nullable();
            $table->date('premiums_start_date_hijry')->nullable();
            $table->decimal('contract_value')->nullable();
            $table->decimal('total_profit')->nullable();
            $table->decimal('first_payment')->nullable()->default(0.0);
            $table->integer('account_id')->nullable();
            $table->integer('premiums_number')->nullable();
            $table->date('last_date')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('fees',10,2)->nullable()->default(0.0);
            $table->decimal('contract_fees_payment',10,2)->nullable()->default(0.0);
            $table->tinyInteger('profit_type')->nullable();
            $table->tinyInteger('profit_pay_type')->nullable();
            $table->integer('commission_account')->nullable();

            //Contract Order
            $table->date('payment_date')->nullable();
            //end Contract Order
            
            $table->decimal('premiums_value')->nullable();
            $table->decimal('last_premium')->nullable();
            $table->decimal('contract_profit')->nullable();
            $table->decimal('contract_profit_payment')->nullable()->default(0);
            $table->tinyInteger('quittance')->default(0); //mokhalsa مخالصة للعقد
            $table->integer('status')->nullable()->default(0);
            $table->tinyInteger('kind')->nullable();
            $table->timestamps();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->foreign('investor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

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
        Schema::dropIfExists('contracts');
    }
}
