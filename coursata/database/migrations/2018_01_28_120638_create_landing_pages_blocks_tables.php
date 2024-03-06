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
            $table->boolean('in_home')->default(false);
            $table->boolean('in_menu')->default(false);
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("landing_page_translations", function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->boolean("lang_status")->default(false); //if the lang have code or not
            $table->longText("description")->nullable();
            $table->json('json_code')->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("landing_page_id")->unsigned();
            $table->unique(['locale', 'landing_page_id']);
            $table->foreign('landing_page_id')->references("id")->on("landing_pages")->onDelete("cascade");
        });


         Schema::create("landing_blocks", function (Blueprint $table) {
            $table->increments('id');
            $table->text("block_name")->nullable();
            $table->unsignedInteger("page_id");
            $table->string("block_type");  //static || dynamic
            $table->string("data_type");  //hotels, packages, cities ... etc
            $table->integer("data_amount")->default(6); //Number of retriative items ex: get 10 hotels
            $table->unsignedInteger("country_id")->nullable();
            $table->unsignedInteger("city_id")->nullable();
            $table->unsignedInteger("category_id")->nullable();
            $table->boolean("data_featured")->default(false); //get only from featured
            $table->text("original_url")->nullable();
            $table->longText("html_code")->nullable();  
            $table->text("loader_function")->nullable();
            $table->integer("height")->nullable();
            $table->boolean('global')->default(false);
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
