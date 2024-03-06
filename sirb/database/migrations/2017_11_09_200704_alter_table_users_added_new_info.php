<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsersAddedNewInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("nationality", 150)->nullable();
            $table->string("city_name")->nullable();
            $table->string("state_name")->nullable();
            $table->text("address_line1")->nullable();
            $table->text("address_line2")->nullable();
            $table->unsignedInteger("country_id")->nullable(); //of residental
            $table->string("mobile", 20)->nullable();
            $table->string("whatsapp", 20)->nullable();
            $table->foreign("country_id")->references("id")->on("countries")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn("nationality");
            $table->dropColumn("city_name");
            $table->dropColumn("state_name");
            $table->dropColumn("address_line1");
            $table->dropColumn("address_line2");
            $table->dropColumn("country_id"); 
            $table->dropColumn("mobile");
            $table->dropColumn("whatsapp");
        });
    }
}
