<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("products",function (Blueprint $table){
            $table->increments("id");
            $table->integer("category_id")->unsigned();
            $table->text("photo")->nullable();
            $table->float("price");
            $table->float("promotion");
            $table->integer("created_by")->unsigned();;
            $table->integer("updated_by")->unsigned();;
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("created_by")->references("id")->on("users")->onDelete("no action");
            $table->foreign("updated_by")->references("id")->on("users")->onDelete("no action");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
        });

        Schema::create("product_translations",function (Blueprint $table){
            $table->increments("id");
            $table->string("name");
            $table->text("details")->nullable();
            $table->integer("product_id")->unsigned();
            $table->string("locale")->index();
            $table->unique(['product_id','locale']);
            $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("product_translations");
        Schema::drop("products");
    }
}
