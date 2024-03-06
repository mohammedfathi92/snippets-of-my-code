<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCurrenciesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("permissions")->insert([
            ["name" => "show currencies", "module" => 'currencies', "label" => "Show Currencies", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "create currencies", "module" => 'currencies', "label" => "Create Currencies", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "edit currencies", "module" => 'currencies', "label" => "Edit Currencies", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["name" => "delete currencies", "module" => 'currencies', "label" => "Delete Currencies", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
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
            ->where("name", "show currencies")
            ->orWhere("name", "create currencies")
            ->orWhere("name", "edit currencies")
            ->orWhere("name", "delete currencies")
            ->delete();
    }
}
