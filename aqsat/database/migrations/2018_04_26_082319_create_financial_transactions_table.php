<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable(); //from user
           
            $table->unsignedInteger('contract_id')->nullable();
            $table->unsignedInteger('premium_id')->nullable();
            $table->unsignedInteger('account_id')->nullable(); //from account
            $table->string('type');
            $table->decimal('price');
            $table->text('notes');
            $table->unsignedInteger('to_user')->unsigned()->nullable();
            $table->unsignedInteger('to_account')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('target_id')->unsigned()->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('is_active')->default(true);
       
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('premium_id')->references('id')->on('contract_premiums')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('company_accounts')->onDelete('cascade');
            $table->foreign('to_account')->references('id')->on('company_accounts')->onDelete('cascade');
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->foreign('to_user')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('target_id')->references('id')->on('targets')->onDelete('cascade');


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
        Schema::dropIfExists('financial_transactions');
    }
}
