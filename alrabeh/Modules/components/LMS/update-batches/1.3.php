<?php

if (\Schema::hasTable('courses') && !\Schema::hasColumn('courses', 'featured_image_link')) {
    try {

        \Schema::table('courses', function ($table) {
            $table->string('template')->change();
        });

        \Schema::table('courses', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->string('featured_image_link')->after('template')->nullable();
        });
        \Schema::table('courses', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->string('extras')->after('featured_image_link')->nullable();
        });
    } catch (\Exception $exception) {
        log_exception($exception);
    }
}
