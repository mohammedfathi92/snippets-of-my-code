<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("pages", function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('icon_class')->nullable();
            $table->text('photo')->nullable();
            $table->boolean('in_menu')->default(true);
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("page_translations", function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->longText("content")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("page_id")->unsigned();
            $table->unique(['locale', 'page_id']);
            $table->foreign('page_id')->references("id")->on("pages")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_translations');
        Schema::dropIfExists('pages');
    }
}
