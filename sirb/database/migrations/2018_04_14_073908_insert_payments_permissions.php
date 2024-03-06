<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPaymentsPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
              DB::table("permissions")->insert([
            ["name" => "show payments", "label" => "Show Payments", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create payments", "label" => "Create payments", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit payments", "label" => "Edit payments", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete payments", "label" => "Delete payments", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
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
            ->where("name", "show payments")
            ->orWhere("name", "create payments")
            ->orWhere("name", "edit payments")
            ->orWhere("name", "delete payments")
            ->delete();
    }
}
