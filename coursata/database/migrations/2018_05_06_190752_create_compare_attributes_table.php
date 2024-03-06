<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompareAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()  //compare attributes
    {
            Schema::create("compare_attrs", function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->nullable();
            $table->string('icon')->nullable();
            $table->string('type')->nullable();
            $table->integer('order')->default(1);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create("compare_attr_translations", function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("locale", 3)->index();
            $table->integer("compare_attr_id")->unsigned();
            $table->unique(['locale', 'compare_attr_id']);
            $table->foreign('compare_attr_id')->references("id")->on("compare_attrs")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('compare_attr_translations');
        Schema::dropIfExists('compare_attrs');
    }
}
