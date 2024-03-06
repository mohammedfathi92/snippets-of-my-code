<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertBookingPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("permissions")->insert([
            ["name" => "show bookings", "label" => "Show Bookings", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create bookings", "label" => "Create Bookings", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit bookings settings", "label" => "Update Bookings Settings", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit bookings", "label" => "Update Bookings", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete bookings", "label" => "Delete Bookings", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
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
            ->where("name", "show bookings")
            ->orWhere("name", "edit bookings settings")
            ->orWhere("name", "edit bookings")
            ->orWhere("name", "delete bookings")
            ->delete();
    }
}
