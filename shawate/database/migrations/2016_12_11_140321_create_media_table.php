<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("media", function (Blueprint $table) {
            $table->increments("id");
            $table->string("title")->nullable();
            $table->text("name");
            $table->text("full_path");
            $table->string("extension", "5");
            $table->string("module");
            $table->string("key");
            $table->string("mime_type");
            $table->integer("module_id");
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
        Schema::dropIfExists('media');
    }
}
