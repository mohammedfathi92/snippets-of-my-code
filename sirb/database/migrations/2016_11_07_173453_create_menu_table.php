<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('show_title')->default(0);
            $table->string('position')->default("main_menu");
            $table->string('css_class')->nullable();
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        Schema::create('menu_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string("locale", 3)->index();
            $table->integer("menu_id")->unsigned();

            $table->unique(['locale', 'menu_id']);
            $table->foreign('menu_id')->references("id")->on("menus")->onDelete("cascade");
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('menu_id')->nullable();
            $table->string('url')->default("#")->nullable();
            $table->string('target')->default('_self');
            $table->string('icon_class')->nullable();
            $table->string('css_class')->nullable();
            $table->string('color')->nullable();
            $table->integer('parent_id')->default(0)->nullable();
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });

        Schema::create('menu_item_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string("locale", 3)->index();
            $table->integer("menu_item_id")->unsigned();
            $table->unique(['locale', 'menu_item_id']);
            $table->foreign('menu_item_id')->references("id")->on("menu_items")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_item_translations');
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menu_translations');
        Schema::dropIfExists('menus');
    }
}
