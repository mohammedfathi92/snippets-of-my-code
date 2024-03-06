<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPagesBlocksTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create("landing_pages", function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->text('photo')->nullable();
            $table->unsignedInteger('menu_id')->nullable();
            $table->boolean('in_home')->default(false);
            $table->boolean('in_menu')->default(false);
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('menu_id')->references("id")->on("menus")->onDelete("cascade");
        });

        Schema::create("landing_page_translations", function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("menu_style")->nullable();
            $table->integer("footer_style")->nullable();
            $table->string("page_color")->nullable();
            $table->boolean("lang_status")->default(false); //if the lang have code or not
            $table->longText("description")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("landing_page_id")->unsigned();
            $table->unique(['locale', 'landing_page_id']);
            $table->foreign('landing_page_id')->references("id")->on("landing_pages")->onDelete("cascade");
        });


        //landing_blocks
         Schema::create("landing_blocks", function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("page_id");
            $table->boolean('is_dynamic');
            $table->string("block_type");
            $table->longText("content");
            $table->text("description")->nullable();       
            $table->unsignedInteger("country_id")->nullable();
            $table->unsignedInteger("city_id")->nullable();
            $table->unsignedInteger("category_id")->nullable();
            $table->integer("amount")->default(8); 
            $table->integer("order")->default(0); 
            $table->boolean('status')->default(true);
            $table->string("lang")->default("ar"); 
            $table->foreign('page_id')->references("id")->on("landing_pages")->onDelete("cascade");
            $table->foreign('country_id')->references("id")->on("countries")->onDelete("cascade");
            $table->foreign('city_id')->references("id")->on("cities")->onDelete("cascade");
            $table->foreign('category_id')->references("id")->on("categories")->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landing_blocks');
        Schema::dropIfExists('landing_page_translations');
        Schema::dropIfExists('landing_pages');
    }
}
