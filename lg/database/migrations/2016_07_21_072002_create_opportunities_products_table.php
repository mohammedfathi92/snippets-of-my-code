<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunitiesProductsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create("opportunities_products", function (Blueprint $table) {
            $table->increments("id");
            $table->integer("opportunity_id")->unsigned();
            $table->integer("product_id")->unsigned();
            $table->integer("quantity");
            $table->float("price");
            $table->foreign("opportunity_id")->references("id")->on("opportunities")->onDelete("cascade");
            $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop("opportunities_products");
    }
}
