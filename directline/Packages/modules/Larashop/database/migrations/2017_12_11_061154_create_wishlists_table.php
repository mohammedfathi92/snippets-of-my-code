<?php

namespace Packages\Modules\Larashop\database\migrations;


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlistsTable extends Migration
{

    public function up()
    {
        Schema::create('ecommerce_wishlists', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('ecommerce_products')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ecommerce_wishlists');
    }
}
