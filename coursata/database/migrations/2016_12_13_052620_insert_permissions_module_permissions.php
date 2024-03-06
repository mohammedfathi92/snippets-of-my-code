<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPermissionsModulePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("permissions")->insert([
            ["name" => "show permissions","label"=>"Show Countries", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create permissions","label"=>"Create Countries", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit permissions","label"=>"Edit Countries", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete permissions","label"=>"Delete Countries", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
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
            ->orWhere("name", "create permissions")
            ->orWhere("name", "edit permissions")
            ->orWhere("name", "delete permissions")
            ->delete();
    }
}
