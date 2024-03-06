<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterOpportunitiesProductsPivotsAddCategoryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("opportunities_products", function (Blueprint $table) {
            $table->unsignedInteger("category_id")->nullable();
        });
        Schema::table("opportunities_products", function (Blueprint $table) {
            $table->foreign("category_id")
                ->references("id")
                ->on("categories")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
