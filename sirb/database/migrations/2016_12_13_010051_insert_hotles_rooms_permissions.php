<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertHotlesRoomsPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("permissions")->insert([

            /*Hotels Permissions*/
            ["name" => "show hotels", "label" => "Show Hotels", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create hotels", "label" => "Create Hotels", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit hotels", "label" => "Edit Hotels", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete hotels", "label" => "Delete Hotels", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            /*Hotels Services Permissions*/
            ["name" => "show hotels services", "label" => "Show Hotels services", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create hotels services", "label" => "Create Hotels services", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit hotels services", "label" => "Edit Hotels services", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete hotels services", "label" => "Delete Hotels services", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            /*Rooms Permissions*/
            ["name" => "show rooms", "label" => "Show Hotels", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create rooms", "label" => "Create Hotels", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit rooms", "label" => "Edit Hotels", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete rooms", "label" => "Delete Hotels", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            /*Rooms Services Permissions*/
            ["name" => "show rooms services", "label" => "Show Rooms services", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create rooms services", "label" => "Create Rooms services", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit rooms services", "label" => "Edit Rooms services", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete rooms services", "label" => "Delete Rooms services", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
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
            ->where("name", "show hotels")
            ->orWhere("name", "create hotels")
            ->orWhere("name", "edit hotels")
            ->orWhere("name", "delete hotels")
            ->orWhere("name", "show hotels services")
            ->orWhere("name", "create hotels services")
            ->orWhere("name", "edit hotels services")
            ->orWhere("name", "delete hotels services")
            ->orWhere("name", "show rooms")
            ->orWhere("name", "create rooms")
            ->orWhere("name", "edit rooms")
            ->orWhere("name", "delete rooms")
            ->orWhere("name", "show rooms services")
            ->orWhere("name", "create rooms services")
            ->orWhere("name", "edit rooms services")
            ->orWhere("name", "delete rooms services")
            ->delete();
    }
}
