<?php

namespace Packages\Modules\Larashop\database\migrations;


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    public function up()
    {
        if (!\Schema::hasTable('ratings')) {

            Schema::create('ratings', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('rating');
                $table->string('title');
                $table->string('body');
                $table->morphs('reviewrateable');
                $table->morphs('author');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
