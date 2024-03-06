<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCitiesTableAddState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->unsignedInteger('state_id')->nullable();
            $table->boolean('is_state')->default(false);
            $table->foreign('state_id')->references("id")->on("cities")->onUpdate('cascade')->onDelete('set null');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities', function($table) {
         $table->dropColumn(['state_id', 'is_state']);
         $table->dropForeign('cities_state_id_foreign');
         });
    }
}
