<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Hotels Table
        Schema::create('student_tips', function (Blueprint $table) {
            $table->increments('id');
            $table->text('photo')->nullable();
            $table->tinyInteger('show_type')->default(1); //where the tips will showen 
            //[ 1=>for public, 2=> for all registerd, 3=> only courses subscribers ]
            $table->boolean('in_home')->default(1);
            $table->unsignedInteger('category_id');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('category_id')->references("id")->on("categories")->onDelete("cascade");

        });

        Schema::create('student_tip_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("student_tip_id")->unsigned();
            $table->unique(['locale', 'student_tip_id']);
            $table->foreign('student_tip_id')->references("id")->on("student_tips")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("student_tip_translations");
        Schema::dropIfExists("student_tips");
    }
}
