<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePackagesAddChildrenAndBabies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("packages", function (Blueprint $table) {
            $table->renameColumn('people_count', "adults_count");
            $table->unsignedInteger("childrens_count")->default(0);
            $table->unsignedInteger("babies_count")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("packages", function (Blueprint $table) {
            $table->renameColumn("adults_count", 'people_count');
            $table->dropColumn("childrens_count");
            $table->dropColumn("babies_count");
        });
    }
}
