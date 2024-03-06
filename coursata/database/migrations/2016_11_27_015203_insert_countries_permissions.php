<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCountriesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("permissions")->insert([
            ["name" => "show countries","label"=>"Show Countries", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create countries","label"=>"Create Countries", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit countries","label"=>"Edit Countries", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete countries","label"=>"Delete Countries", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            ["name" => "show cities","label"=>"Show Cities", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create cities","label"=>"Create Cities", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit cities","label"=>"Edit Cities", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete cities","label"=>"Delete Cities", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
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
            ->orWhere("name", "create countries")
            ->orWhere("name", "edit countries")
            ->orWhere("name", "delete countries")
            ->where("name", "show cities")
            ->orWhere("name", "create cities")
            ->orWhere("name", "edit cities")
            ->orWhere("name", "delete cities")
            ->delete();
    }
}
