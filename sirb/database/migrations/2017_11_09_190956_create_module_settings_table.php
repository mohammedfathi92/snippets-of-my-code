<?php

/**
*
* Module settings like (allaw comments for module (ex: Hilton hotel page))
*
*/

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("module_settings", function (Blueprint $table) {
            $table->increments("id");
            $table->string("key"); //key of setting => ex: allaw_comments || allaw_reviews || allaw_comments_reviews .. etc
            $table->text('details')->nullable();
            $table->string("module"); // ex: Hotels || places || articles
            $table->integer("module_id");
            $table->text('value'); // 0 =>Not allawable , 1=>allawable
            $table->string('in_local')->default('all'); // do this action in spasific page lang => ex: all || en || ar .... .
            $table->timestamps();

            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists("module_settings");
    }
}
