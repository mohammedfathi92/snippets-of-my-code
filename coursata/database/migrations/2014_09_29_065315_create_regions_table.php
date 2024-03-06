<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("regions", function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('region_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("region_id")->unsigned();
            $table->unique(['locale', 'region_id']);
            $table->foreign('region_id')->references("id")->on("regions")->onDelete("cascade");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("region_translations");
        Schema::dropIfExists("regions");
    }
}
