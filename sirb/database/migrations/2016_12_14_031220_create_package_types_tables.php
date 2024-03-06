<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTypesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Packages types Table
        Schema::create('package_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('country_id')->references("id")->on("countries")->onDelete("cascade");
        });

        // Packages types Table
        Schema::create('package_type_translations', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name")->nullable();
            $table->text("description")->nullable();
            $table->text("notes")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("package_type_id")->unsigned();
            $table->unique(['locale', 'package_type_id']);
            $table->foreign('package_type_id')->references("id")->on("package_types")->onDelete("cascade");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("package_type_translations");
        Schema::dropIfExists("package_types");
    }
}
