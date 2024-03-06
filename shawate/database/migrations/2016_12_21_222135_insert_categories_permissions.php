<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCategoriesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("permissions")->insert([
            ["name" => "show categories", "label" => "Show Categories", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create categories", "label" => "Create Categories", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit categories", "label" => "Edit Categories", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete categories", "label" => "Delete Categories", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
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
            ->where("name", "show categories")
            ->orWhere("name", "create categories")
            ->orWhere("name", "edit categories")
            ->orWhere("name", "delete categories")
            ->delete();
    }
}
