<?php

use \Illuminate\Database\Schema\Blueprint;

if (!\Schema::hasTable('courseables') ) {

    \Schema::create('courseables', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('content_id');
        $table->morphs('courseable');
        $table->morphs('sourcable');
        $table->timestamps();
    });
}