<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');  //ex: Mohammed
            $table->string('last_name');   //ex: Zedan
            $table->string('name')->nullable(); //show name ex:Mohammed Zedan 
            $table->string('email')->unique();
            $table->string('password');
            $table->string('slug');
            $table->integer('level'); // user permission level . 0=>super admin , 1=>admin 2=> normal user
            $table->char('gender')->default("m");// "m" for male or "f" for female
            $table->string('lang')->default("ar"); # ar/en
            $table->string('avatar')->nullable();
            $table->string('about')->nullable();
            $table->string('facebook')->nullable();
            //new 2
            $table->string('whatsapp')->nullable();
            $table->string('snap_chat')->nullable();
            $table->string('website')->nullable();
            //end new2
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('gplus')->nullable();
            $table->string('instagram')->nullable();
            $table->enum('register_type', ['signup', 'facebook', 'linkedin', 'google'])->default('signup');
            $table->string('register_type_id')->nullable();
            //new 1
            $table->text('address_line1')->nullable();
            $table->text('address_line2')->nullable();
            
            $table->string('city_name')->nullable();
            $table->boolean('is_advisor')->default(false);
            //end new 1

            $table->text('phone')->nullable();
            $table->date("birth_date")->nullable();
            $table->unsignedInteger('residence_place')->nullable();  //residental country
            $table->unsignedInteger('nationality')->nullable(); 
            $table->text('state_name')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->string('zip_code')->nullable();
            
            $table->rememberToken();
            $table->timestamps();

            $table->foreign("residence_place")->references("id")->on("countries")->onDelete("cascade");
            $table->foreign("nationality")->references("id")->on("countries")->onDelete("cascade"); 
            $table->foreign("city_id")->references("id")->on("cities")->onDelete("cascade");
        });

        Artisan::call('db:seed',['--class'=>'UsersSeeder']);



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
