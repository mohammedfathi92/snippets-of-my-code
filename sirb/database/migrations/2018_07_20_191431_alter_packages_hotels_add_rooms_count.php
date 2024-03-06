<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPackagesHotelsAddRoomsCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages_cities_hotels_rooms', function (Blueprint $table) {
            $table->integer("rooms_count")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages_cities_hotels_rooms', function (Blueprint $table) {
            $table->dropColumn("rooms_count");
        });
    }
}
