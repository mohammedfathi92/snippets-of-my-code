<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertInstitutesCoursesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("permissions")->insert([

            /*Institutes Permissions*/
            ["name" => "show institutes", "label" => "Show Institutes", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create institutes", "label" => "Create Institutes", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit institutes", "label" => "Edit Institutes", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete institutes", "label" => "Delete Institutes", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            /*Institutes Services Permissions*/
            ["name" => "show services", "label" => "Show Institutes services", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create services", "label" => "Create Institutes services", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit services", "label" => "Edit Institutes services", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete services", "label" => "Delete Institutes services", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            /*Courses Permissions*/
            ["name" => "show courses", "label" => "Show Institutes", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create courses", "label" => "Create Institutes", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit courses", "label" => "Edit Institutes", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete courses", "label" => "Delete Institutes", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

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
            ->where("name", "show institutes")
            ->orWhere("name", "create institutes")
            ->orWhere("name", "edit institutes")
            ->orWhere("name", "delete institutes")
            ->orWhere("name", "show services")
            ->orWhere("name", "create services")
            ->orWhere("name", "edit services")
            ->orWhere("name", "delete services")
            ->orWhere("name", "show courses")
            ->orWhere("name", "create courses")
            ->orWhere("name", "edit courses")
            ->orWhere("name", "delete courses")
            ->delete();
    }
}
