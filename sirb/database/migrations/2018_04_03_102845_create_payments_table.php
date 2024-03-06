<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("payments", function (Blueprint $table) {
            $table->increments("id");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("full_name")->nullable();
            $table->string("whatsapp")->nullable();
            $table->integer("package_num")->nullable();
            $table->unsignedInteger("package_type_id")->nullable();
            $table->unsignedInteger("package_id")->nullable();
            $table->unsignedInteger("country_id")->nullable();
            $table->text("package_url")->nullable();
            $table->string("city")->nullable();
            $table->text("address")->nullable();
            $table->text("nationality")->nullable();
            $table->text("payment_url")->nullable();
            $table->text("payment_code")->nullable();
            $table->string("payment_method")->nullable();
            $table->string("payer_email")->nullable();
            $table->string("card_number")->nullable();
            $table->string("payer_id")->nullable();
            $table->string("payment_id")->nullable();
            $table->unsignedInteger("created_by")->nullable();
            $table->integer("price")->nullable();
            $table->integer("fees")->default(0);
            $table->text("title")->nullable();
            $table->text("details")->nullable();
            $table->text("admin_note")->nullable();
            $table->text("client_note")->nullable();
            $table->string("currency")->nullable();
            $table->unsignedInteger("client_id")->nullable();
            $table->string("issue_type")->nullable(); 
            $table->text("issue_description")->nullable();
            $table->tinyInteger("status")->default(0); // 1= pending, 2= confirmed, 3=closed, 4=canceled
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("client_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("created_by")->references("id")->on("users")->onDelete("cascade");
             $table->foreign("country_id")->references("id")->on("countries")->onDelete("cascade");
             $table->foreign("package_type_id")->references("id")->on("package_types")->onDelete("cascade");
            $table->foreign("package_id")->references("id")->on("packages")->onDelete("cascade");
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("payments");
    }
}
