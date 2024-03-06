<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertTestimonialsPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("permissions")->insert([
            ["name" => "show testimonials", "label" => "Show Testimonials", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create testimonials", "label" => "Create Testimonials", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit testimonials", "label" => "Update Testimonials", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete testimonials", "label" => "Delete Testimonials", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("permissions")
            ->where("name", "show testimonials")
            ->orWhere("name", "create testimonials")
            ->orWhere("name", "edit testimonials")
            ->orWhere("name", "delete testimonials")
            ->delete();
    }
}
