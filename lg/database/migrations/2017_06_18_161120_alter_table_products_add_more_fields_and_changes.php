<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterTableProductsAddMoreFieldsAndChanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("products", function (Blueprint $table) {
            $table->float("price")->nullable()->change();
            $table->float("promotion")->nullable()->change();
            $table->text("photo")->default("/assets/images/no-product-image.jpg")->nullable()->change();
            $table->enum("product_type", ['b2b', 'b2c'])->nullable();
        });
        Schema::table("product_translations", function (Blueprint $table) {
            $table->string("name")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("products", function (Blueprint $table) {
            $table->dropColumn("product_type");
        });
    }
}
