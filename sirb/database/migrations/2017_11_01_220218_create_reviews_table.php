<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('review_topics', function (Blueprint $table) {

         $table->increments('id');
         $table->enum("rate_type", ['stars', 'percent','text'])->default('stars');
         
         $table->timestamps();

        });


        Schema::create('review_topic_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("description")->nullable();
            $table->string("locale", 3)->index();
            $table->integer("topic_id")->unsigned();
            $table->unique(['locale', 'topic_id']);
            $table->foreign('topic_id')->references("id")->on("review_topics")->onDelete("cascade");
        });


        Schema::create('reviews', function (Blueprint $table) {

         $table->increments('id');
         $table->integer('amount')->default(1); //Number of stars || percent
         $table->text('rate_comment')->nullable(); //if its type is tex review
         $table->string('local')->nullable(); //en - ar - all--- etc
         $table->string('module_type'); //hotels - packages - cities ... etc
         $table->tinyInteger('module_id');
         $table->enum("creator_type", ['member', 'guest'])->default('guest');
         $table->boolean('status')->default(1);
         $table->unsignedInteger('topic_id')->nullable();
         $table->unsignedInteger('member_id')->nullable();
         $table->unsignedInteger('guest_id')->nullable();
         $table->timestamps();

         $table->foreign('topic_id')->references("id")->on("review_topics")->onDelete("cascade");
         $table->foreign('member_id')->references("id")->on("users")->onDelete("cascade");
         $table->foreign('guest_id')->references("id")->on("guests")->onDelete("cascade");
        


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists("review_topic_translations");
       Schema::dropIfExists("review_topics");
       Schema::dropIfExists("reviews");
    }
}
