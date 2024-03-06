<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("opportunities",function (Blueprint $table){
            $table->increments("id");
            $table->string("client_name");
            $table->text("details");
            $table->date("deliver_at");
            $table->date("delivered_at");
            $table->integer("user_id")->unsigned();
            $table->integer("updated_by");
            $table->integer("progress");
            $table->longText("close_attachments")->nullable();
            $table->integer("status");
            $table->integer("status_changed_by");
            $table->float("total_price");
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("opportunities");
    }
}
