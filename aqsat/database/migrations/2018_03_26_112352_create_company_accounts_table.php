<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('user_name')->nullable();
            $table->string('user_type')->nullable();
            $table->string('account_name')->nullable();
            $table->integer('account_number')->nullable();
            $table->decimal('account_value')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
            $table->boolean('is_active')->default(true);
           
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
        Schema::dropIfExists('company_accounts');
    }
}
