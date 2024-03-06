<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ERPTables extends Migration
{

 protected $module_prefix = "erp_";


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

    // currencies
        Schema::create($this->module_prefix .'currencies', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('code', 10)->index();
            $table->string('symbol', 25);
            $table->string('format', 50);
            $table->tinyInteger('status')->default(0);

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        // currencies rates
        Schema::create($this->module_prefix .'currencies_rates', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->decimal('rate',8,4);
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default(0);

            $table->unsignedInteger('currency_id')->nullable()->index();

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('currency_id')->references('id')->on($this->module_prefix.'currencies')->onDelete('cascade')->onUpdate('cascade');
        });

        //countries
        Schema::create($this->module_prefix .'countries', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 255)->default('');
            $table->decimal('tax',8,3)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('code', 64)->unique()->nullable()->comment('City Code');
            $table->unsignedInteger('currency_id')->nullable()->index();

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');

            
        });

        //cities

        Schema::create($this->module_prefix .'cities', function (Blueprint $table) {
            $table->increments('id')->comment('Auto increase ID');
            $table->unsignedInteger('parent_id')->nullable();
            $table->integer('country_id')->unsigned()->comment('Country ID');
            $table->string('name', 255)->default('')->comment('City Name');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0);


            $table->string('code', 64)->unique()->nullable()->comment('City Code');
            $table->index(['country_id','name'], 'uniq_city');

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
             $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'cities')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onUpdate('CASCADE')->onDelete('CASCADE');

        });

                 // branches 

        Schema::create($this->module_prefix . 'branches', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable(); 
            $table->text('email')->nullable();
            $table->text('primary_phone')->nullable();
            $table->text('phone_one')->nullable();
            $table->text('phone_two')->nullable();
            $table->text('phone_three')->nullable();
            $table->text('fax_number')->nullable();
            $table->text('address')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->text('website_link')->nullable();

            $table->unsignedInteger('country_id')->nullable()->index();
            $table->unsignedInteger('city_id')->nullable()->index();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->unsignedInteger('parent_user')->nullable();

            $table->timestamps();

            $table->foreign('parent_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');


        });

    //categories
        Schema::create($this->module_prefix . 'categories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('slug')->unique()->nullable()->index();
            $table->string('type')->nullable()->default('general');
            $table->longText('description')->nullable();
            $table->text('notes')->nullable();
            $table->string('is_featured')->default(0);
            $table->integer('room_num')->default(1)->nullable();
            $table->tinyInteger('status')->default(0);

            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();


            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'categories')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('branch_id')->references('id')->on($this->module_prefix . 'branches')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('country_id')->references('id')->on($this->module_prefix . 'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix . 'cities')->onDelete('cascade')->onUpdate('cascade');


        });




        //categoriables


        Schema::create($this->module_prefix . 'categoriables', function (Blueprint $table) {
            $table->string($this->module_prefix . 'categoriable_type');
            $table->unsignedInteger($this->module_prefix . 'categoriable_id');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('cascade')->onUpdate('cascade');
        });





        //fees & taxes


    Schema::create($this->module_prefix .'fees', function (Blueprint $table) {

    $table->increments('id');
    $table->text('name');
    $table->string('feesable_type');
    $table->unsignedInteger('feesable_id');
            $table->string('type')->default('tax'); //, ['fee', 'tax']
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on($this->module_prefix . 'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix . 'cities')->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('branch_id')->references('id')->on($this->module_prefix . 'branches')->onDelete('cascade')->onUpdate('cascade');
        });


        Schema::create($this->module_prefix .'fees_values', function (Blueprint $table) {

            $table->increments('id');
            $table->text('notes')->nullable();
            $table->decimal('value', 8, 3)->default(0.00);
            $table->string('value_type')->default('percent'); //,['fixed', 'percent']
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('parent_id')->nullable();
            
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'fees')->onDelete('cascade')->onUpdate('cascade');
            
        });


        // places

        Schema::create($this->module_prefix . 'places', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('primary_phone')->nullable();
            $table->text('phone_one')->nullable();
            $table->text('phone_two')->nullable();
            $table->text('phone_three')->nullable();
            $table->text('fax_number')->nullable();
            $table->text('website_link')->nullable();
            $table->string('email')->nullable();  
            $table->longText('description')->nullable();
            $table->text('notes')->nullable();
            $table->string('reg_code')->unique()->nullable();
            $table->decimal('price',8,2)->nullable();
            $table->decimal('new_price',8,2)->nullable();  
            $table->decimal('season_price',8,2)->nullable();
            $table->integer('place_level')->defaut(1);
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('map_location')->nullable();

            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('category_id')->nullable()->index();
            $table->unsignedInteger('country_id')->nullable()->index();
            $table->unsignedInteger('city_id')->nullable()->index();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');


        });



        // hotels

        Schema::create($this->module_prefix . 'hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->decimal('tax',5,2)->nullable();
            $table->longText('description')->nullable();
            $table->text('notes')->nullable();
            $table->integer('rooms_num')->nullable();
            $table->text('primary_phone')->nullable();
            $table->text('phone_one')->nullable();
            $table->text('phone_two')->nullable();
            $table->text('phone_three')->nullable();
            $table->text('fax_number')->nullable();
            $table->decimal('prepay_percent',8,2)->nullable();
            $table->date('start_year')->nullable();
            $table->string('email')->nullable();  
            $table->string('website_link')->nullable();
            $table->text('video_code')->nullable();
            $table->string('reg_code')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('map_location')->nullable();
            $table->integer('hotel_level')->defaut(1);
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('place_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('place_id')->references('id')->on($this->module_prefix .'places')->onDelete('set null')->onUpdate('cascade');
             $table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onDelete('set null')->onUpdate('cascade');
        });

        // rooms

        Schema::create($this->module_prefix . 'rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->longText('description')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('breakfast')->default(false);
            $table->decimal('price',8,2)->nullable();
            $table->decimal('new_price',8,2)->nullable();  
            $table->decimal('season_price',8,2)->nullable();
            $table->string('reg_code')->unique()->nullable();
            $table->text('video_code')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('hotel_id')->nullable()->index();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on($this->module_prefix .'hotels')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');


        });

        // travels 

        Schema::create($this->module_prefix . 'travels', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('notes')->nullable();
            $table->text('description')->nullable();
            $table->text('tour_url')->nullable();
            $table->string('reg_code')->unique()->nullable();

            $table->tinyInteger('status')->default(0);

            $table->unsignedInteger('category_id')->nullable();
            
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');

             $table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onDelete('set null')->onUpdate('cascade');



        });

        //drivers
        Schema::create($this->module_prefix . 'drivers', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('monthly_salary',8,2)->nullable();
            $table->decimal('hourly_salary',8,2)->nullable();
            $table->decimal('per_trip_salary',8,2)->nullable();
            $table->decimal('fixed_allowance',8,2)->nullable();

            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });

                // vehicles

        Schema::create($this->module_prefix . 'vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('vehicle_number')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('model_year')->nullable();
            $table->longText('description')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('provider_id')->nullable();
            $table->unsignedInteger('category_id')->nullable()->index();
            $table->unsignedInteger('driver_id')->nullable()->index();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onDelete('cascade')->onUpdate('cascade');


        });

        // transport prices

        Schema::create($this->module_prefix . 'transport_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('provider_id')->nullable();
            $table->unsignedInteger('from_country_id')->nullable();
            $table->unsignedInteger('to_country_id')->nullable();
            $table->unsignedInteger('from_city_id')->nullable();
            $table->unsignedInteger('to_city_id')->nullable();
            $table->unsignedInteger('from_place_cat_id')->nullable();
            $table->unsignedInteger('to_place_cat_id')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('travel_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->decimal('currency_rate')->nullable(); //for company Main currency
            $table->unsignedInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            
            $table->foreign('from_place_cat_id')->references('id')->on($this->module_prefix .'categories')->onDelete('set null')->onUpdate('cascade');

            $table->foreign('to_place_cat_id')->references('id')->on($this->module_prefix .'categories')->onDelete('set null')->onUpdate('cascade');

            
            $table->foreign('from_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('travel_id')->references('id')->on($this->module_prefix .'travels')->onDelete('cascade')->onUpdate('cascade');


        });

        // transport prices vehicles

        Schema::create($this->module_prefix . 'transport_prices_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('cost',8,3)->nullable();
            $table->decimal('commission_one',8,3)->nullable();
            $table->decimal('commission_two',8,3)->nullable();
            $table->decimal('commission_three',8,3)->nullable();
            $table->decimal('price',8,3)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('price_id')->nullable();
            $table->unsignedInteger('vehicle_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('price_id')->references('id')->on($this->module_prefix .'transport_prices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vehicle_id')->references('id')->on($this->module_prefix .'vehicles')->onDelete('cascade')->onUpdate('cascade');
         


        });


    // years 

        Schema::create($this->module_prefix . 'years', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

        });




        //hotel room pricing details

        Schema::create($this->module_prefix . 'hotel_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->decimal('price')->nullable();
            $table->text('notes')->nullable();
            $table->string('r_code')->nullable();
            $table->string('s_code')->nullable();
            $table->date('expiry_start');
            $table->date('expiry_end');
            $table->boolean('is_promo')->default(true);
            $table->unsignedInteger('provider_id')->nullable();
            $table->unsignedInteger('year_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('hotel_id')->nullable();
            $table->unsignedInteger('room_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();
            $table->decimal('currency_rate')->nullable(); //for company Main currency
            $table->unsignedInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('branch_id')->nullable();
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('year_id')->references('id')->on($this->module_prefix .'years')->onDelete('cascade')->onUpdate('cascade');
           
            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('hotel_id')->references('id')->on($this->module_prefix .'hotels')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('room_id')->references('id')->on($this->module_prefix .'rooms')->onDelete('cascade')->onUpdate('cascade');



        });

        //days

        Schema::create($this->module_prefix . 'days', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

        });

        // hotel days

        Schema::create($this->module_prefix . 'hotel_prices_days', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->unsignedInteger('hotel_prices_id')->nullable();
            $table->unsignedInteger('days_id')->nullable();


            $table->softDeletes();
            $table->timestamps();

            $table->foreign('hotel_prices_id')->references('id')->on($this->module_prefix .'hotel_prices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('days_id')->references('id')->on($this->module_prefix .'days')->onDelete('cascade')->onUpdate('cascade');


        });


        // dates

        Schema::create($this->module_prefix . 'hotel_prices_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->unsignedInteger('hotel_prices_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();



            $table->softDeletes();
            $table->timestamps();
            $table->foreign('hotel_prices_id')->references('id')->on($this->module_prefix .'hotel_prices')->onDelete('cascade')->onUpdate('cascade');



        });




        // airlines

        Schema::create($this->module_prefix . 'public_transports', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->text('primary_phone')->nullable();
            $table->text('phone_one')->nullable();
            $table->text('phone_two')->nullable();
            $table->text('phone_three')->nullable();
            $table->text('fax_number')->nullable();
            $table->text('website_link')->nullable();
            $table->string('email')->nullable(); 
            $table->string('transpost_type')->default('airline');  
            $table->string('reg_code')->unique()->nullable();  
            $table->decimal('transport_cost',8,2)->nullable();
            $table->decimal('sale_transport_cost',8,2)->nullable();
            


            $table->unsignedInteger('provider_id')->nullable();   
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');


        });


          // public transports prices

        Schema::create($this->module_prefix . 'public_transports_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->date('start_date')->nullable();
            $table->decimal('passenger_price',8,2)->nullable();
            $table->decimal('passenger_cost',8,2)->nullable();
            $table->decimal('cost_adult',8,2)->nullable();
            $table->decimal('price_adult',8,2)->nullable();
            $table->decimal('cost_child',8,2)->nullable();
            $table->decimal('price_child',8,2)->nullable();
            $table->decimal('cost_infant',8,2)->nullable();
            $table->decimal('price_infant',8,2)->nullable();
            $table->unsignedInteger('provider_id')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('transport_id')->nullable();
            $table->unsignedInteger('from_country_id')->nullable();
            $table->unsignedInteger('from_city_id')->nullable();
            $table->unsignedInteger('to_country_id')->nullable();
            $table->unsignedInteger('to_city_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

                        $table->decimal('currency_rate')->nullable(); //for company Main currency
            $table->unsignedInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');


            $table->foreign('transport_id')->references('id')->on($this->module_prefix .'public_transports')->onDelete('cascade')->onUpdate('cascade');

            

            $table->foreign('from_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');


        });



        // bus stations

        Schema::create($this->module_prefix . 'bus_stations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable(); 
            $table->unsignedInteger('country_id')->nullable()->index();
            $table->unsignedInteger('city_id')->nullable()->index();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');


        });


        // airports 

        Schema::create($this->module_prefix . 'airports', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable(); 
            $table->unsignedInteger('country_id')->nullable()->index();
            $table->unsignedInteger('city_id')->nullable()->index();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');


        });

 
        // journey

        Schema::create($this->module_prefix . 'journey', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->unsignedInteger('category_id')->nullable();

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onUpdate('cascade')->onDelete('cascade');

           


        });


      // orders

        Schema::create($this->module_prefix . 'orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_code')->unique()->nullable();
            $table->string('order_status')->nullable();
            $table->boolean('is_template')->default(0);
        $table->integer('duration'); //in day
        $table->dateTime('order_date')->nullable();
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();
        $table->date('arrive_date')->nullable();
        $table->text('order_notes')->nullable();
        $table->decimal('currency_rate')->nullable();
        $table->integer('adult_numbers')->default(0)->nullable();
        $table->integer('child_numbers')->default(0)->nullable();
        $table->integer('infant_numbers')->default(0)->nullable();
        $table->text('agent_notes')->nullable();
        $table->text('promoter_notes')->nullable();
        $table->softDeletes();
        $table->timestamps();

        $table->unsignedInteger('customer_id')->nullable()->index();
        $table->unsignedInteger('agent_id')->nullable();
        $table->unsignedInteger('promoter_id')->nullable();
        $table->unsignedInteger('category_id')->nullable();
        $table->unsignedInteger('referred_by_id')->nullable();
        $table->unsignedInteger('destination_id')->nullable();

        $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();


        $table->unsignedInteger('value_currency_id')->nullable();
        $table->unsignedInteger('branch_currency_id')->nullable();
        $table->unsignedInteger('company_currency_id')->nullable();
                    $table->unsignedInteger('branch_id')->nullable();


            $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('value_currency_id', 'order_val_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('branch_currency_id', 'order_br_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('company_currency_id', 'order_com_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');


        $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('agent_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('promoter_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('destination_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('referred_by_id')->references('id')->on($this->module_prefix .'categories')->onUpdate('cascade')->onDelete('set null');
    });


      // hotel_orders

        Schema::create($this->module_prefix . 'hotel_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_template')->default(0);
            $table->integer('order_day')->nullable();
            $table->integer('rooms_num')->nullable();
            $table->decimal('room_price',8,2)->nullable();
            $table->decimal('auto_room_price',8,2)->nullable();
            $table->string('room_price_type')->nullable();
            $table->decimal('prepay_percent',8,2)->nullable();
            $table->decimal('prepay_percent_type',8,2)->nullable();
            $table->integer('nights')->nullable();
            $table->string('booking_code')->unique()->nullable();
            $table->string('reserve_code')->nullable();
            $table->string('confirmed_reserve_code')->nullable();

            $table->date('checkin')->nullable();
            $table->date('checkout')->nullable();
            $table->tinyInteger('breakfast')->dafault(0);
            $table->date('due_date')->nullable();
            $table->integer('extra_beds')->nullable();
            $table->decimal('extra_beds_prices',8,2)->nullable();
            $table->text('provider_notes')->nullable();
            $table->text('order_notes')->nullable();

        $table->tinyInteger('status')->dafault(0); //payment_status
        $table->decimal('total_price',8,2)->nullable();
        $table->decimal('fees_percent',8,2)->nullable();
        $table->decimal('taxes_percent',8,2)->nullable();
        $table->decimal('branch_currency_rate')->nullable();
        $table->decimal('company_currency_rate')->nullable();
        $table->unsignedInteger('country_id')->nullable();
        $table->unsignedInteger('city_id')->nullable();
        $table->unsignedInteger('taxes_id')->nullable();
        $table->unsignedInteger('fees_id')->nullable();
        $table->unsignedInteger('provider_id')->nullable();
        $table->unsignedInteger('value_currency_id')->nullable();
        $table->unsignedInteger('branch_currency_id')->nullable();
        $table->unsignedInteger('company_currency_id')->nullable();
        $table->unsignedInteger('hotel_price_id')->nullable();

        $table->unsignedInteger('hotel_id')->nullable();
        $table->unsignedInteger('room_id')->nullable(); 
        $table->unsignedInteger('season_id')->nullable();

        $table->unsignedInteger('order_id')->nullable();

        $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();
        $table->softDeletes();
        $table->timestamps();
                    $table->unsignedInteger('branch_id')->nullable();


            $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');


        $table->foreign('value_currency_id', 'htorder_val_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('branch_currency_id', 'htorder_br_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('company_currency_id', 'htorder_com_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');


        $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('order_id')->references('id')->on($this->module_prefix .'orders')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('provider_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('hotel_id')->references('id')->on($this->module_prefix .'hotels')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('hotel_price_id')->references('id')->on($this->module_prefix .'hotel_prices')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('room_id')->references('id')->on($this->module_prefix .'rooms')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('season_id')->references('id')->on($this->module_prefix .'years')->onUpdate('cascade')->onDelete('set null');


    });

      // flight_orders

Schema::create($this->module_prefix . 'public_transports_orders', function (Blueprint $table) {
    $table->increments('id');
    $table->boolean('is_template')->default(0);
    $table->integer('order_day')->nullable();
    $table->dateTime('leave_time')->nullable();
    $table->dateTime('arrive_time')->nullable();
    $table->date('due_date')->nullable();
        $table->string('transport_type')->nullable(); //ferry or flight
        $table->integer('passengers_num')->nullable(); //Passengers
        $table->integer('total_cost')->nullable();
        $table->integer('total_price')->nullable();
        $table->integer('adult_numbers')->nullable();
        $table->integer('child_numbers')->nullable();
        $table->integer('infant_numbers')->nullable();
        $table->decimal('adult_price', 8,2)->nullable();
        $table->decimal('child_price', 8,2)->nullable();
        $table->decimal('infant_price', 8,2)->nullable();
        $table->decimal('adult_cost', 8,2)->nullable();
        $table->decimal('child_cost', 8,2)->nullable();
        $table->decimal('infant_cost', 8,2)->nullable();
        $table->decimal('baggage_weight', 8,2)->nullable();
        $table->decimal('baggage_cost', 8,2)->nullable();
        $table->decimal('baggage_price', 8,2)->nullable();
        $table->string('price_type')->nullable(); //manual
        $table->decimal('prepay_percent',8,2)->nullable();
        $table->string('booking_code')->unique()->nullable();
        $table->string('reserve_code')->nullable();
        $table->string('confirmed_reserve_code')->nullable();
        $table->text('booking_notes')->nullable();
        $table->text('provider_notes')->nullable();  
        $table->decimal('branch_currency_rate')->nullable();
        $table->decimal('company_currency_rate')->nullable();
        $table->decimal('fees_percent',8,2)->nullable();
        $table->decimal('taxes_percent',8,2)->nullable();
        $table->unsignedInteger('value_currency_id')->nullable();
        $table->unsignedInteger('branch_currency_id')->nullable();
        $table->unsignedInteger('company_currency_id')->nullable();
        $table->unsignedInteger('provider_id')->nullable();
        $table->unsignedInteger('transpost_id')->nullable();
        $table->unsignedInteger('transpost_price_id')->nullable();
        $table->unsignedInteger('from_country_id')->nullable();
        $table->unsignedInteger('from_city_id')->nullable();
        $table->unsignedInteger('from_airport_id')->nullable();
        $table->unsignedInteger('to_country_id')->nullable();
        $table->unsignedInteger('to_city_id')->nullable();
        $table->unsignedInteger('to_airport_id')->nullable();
        $table->unsignedInteger('order_id')->nullable();

        $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();

        $table->tinyInteger('status')->dafault(1);
            //0 => pending, 1 => active, 2 => canceled

        $table->softDeletes();
        $table->timestamps();

                    $table->unsignedInteger('branch_id')->nullable();


            $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');



        $table->unsignedInteger('taxes_id')->nullable();
        $table->unsignedInteger('fees_id')->nullable();


        $table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');


        $table->foreign('value_currency_id', 'pubval_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('branch_currency_id', 'pubbr_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('company_currency_id', 'pubcom_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');



        $table->foreign('order_id')->references('id')->on($this->module_prefix .'orders')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('to_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('to_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_airport_id')->references('id')->on($this->module_prefix .'airports')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('to_airport_id')->references('id')->on($this->module_prefix .'airports')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        
        $table->foreign('transpost_price_id')->references('id')->on($this->module_prefix.'public_transports_prices', 'orderpub_trans_prices_id')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('transpost_id')->references('id')->on($this->module_prefix.'public_transports')->onDelete('cascade')->onUpdate('cascade');

    });

    // transport_orders

Schema::create($this->module_prefix . 'transportations_orders', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('order_day')->nullable();
    $table->boolean('is_template')->default(0);
    $table->integer('passengers_num')->nullable();
    $table->integer('vehicle_num')->nullable();
    $table->decimal('vehicle_cost',8,2)->nullable();
    $table->decimal('vehicle_price',8,2)->nullable();
    $table->string('price_type')->nullable();
    $table->text('order_notes')->nullable();
    $table->text('driver_notes')->nullable();
    $table->text('provider_notes')->nullable();
    $table->dateTime('leave_time')->nullable();
    $table->date('due_date')->nullable();
    $table->string('booking_code')->unique()->nullable();
    $table->string('reserve_code')->nullable(); //from provider
    $table->string('confirmed_reserve_code')->nullable();
        $table->decimal('branch_currency_rate')->nullable();
$table->decimal('company_currency_rate')->nullable();
    $table->decimal('fees_percent',8,2)->nullable();
        $table->decimal('taxes_percent',8,2)->nullable();
$table->unsignedInteger('taxes_id')->nullable();
        $table->unsignedInteger('fees_id')->nullable();


$table->unsignedInteger('value_currency_id')->nullable();
$table->unsignedInteger('branch_currency_id')->nullable();
$table->unsignedInteger('company_currency_id')->nullable();


    $table->unsignedInteger('from_country_id')->nullable();
    $table->unsignedInteger('to_country_id')->nullable();
    $table->unsignedInteger('from_city_id')->nullable();
    $table->unsignedInteger('from_place_cat_id')->nullable();
    $table->unsignedInteger('to_place_cat_id')->nullable();
    $table->unsignedInteger('to_city_id')->nullable();
    $table->unsignedInteger('vehicle_id')->nullable();
    $table->unsignedInteger('driver_id')->nullable();
    $table->unsignedInteger('provider_id')->nullable();
    $table->unsignedInteger('transpost_price_id')->nullable();
    
    
    $table->decimal('prepay_percent',8,2)->nullable();

    $table->text('sms_to_driver')->nullable();
    $table->text('sms_to_client')->nullable();
    $table->tinyInteger('status')->dafault(1);
            //0 => pending, 1 => active, 2 => canceled
    $table->unsignedInteger('order_id')->nullable();
    $table->unsignedInteger('created_by')->nullable()->index();
    $table->unsignedInteger('updated_by')->nullable()->index();
    $table->softDeletes();
    $table->timestamps();

            $table->unsignedInteger('branch_id')->nullable();


            $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');


 $table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

$table->foreign('value_currency_id', 'traval_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
$table->foreign('branch_currency_id', 'trabr_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
$table->foreign('company_currency_id', 'tracom_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');


    $table->foreign('order_id')->references('id')->on($this->module_prefix .'orders')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('from_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('to_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('from_place_cat_id')->references('id')->on($this->module_prefix .'categories')->onDelete('cascade')->onUpdate('cascade');

    $table->foreign('to_place_cat_id')->references('id')->on($this->module_prefix .'categories')->onDelete('cascade')->onUpdate('cascade');
    
    $table->foreign('from_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('to_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('vehicle_id')->references('id')->on($this->module_prefix .'vehicles')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('transpost_price_id')->references('id')->on($this->module_prefix .'transport_prices')->onDelete('set null')->onUpdate('cascade');
    
});

// additional services

Schema::create($this->module_prefix . 'services', function (Blueprint $table) {
    $table->increments('id');
    $table->text('name')->nullable();
            $table->string('type')->default('service')->nullable(); //, ['service', 'activity']
            $table->longText('description')->nullable();
            $table->longText('notes')->nullable();
            $table->text('address')->nullable();
            $table->text('map_location')->nullable();
            $table->text('fax')->nullable();
            $table->text('primary_phone')->nullable();
            $table->text('phone_one')->nullable();
            $table->text('phone_two')->nullable();
            $table->text('phone_three')->nullable();
            $table->text('email')->nullable();
            $table->text('website')->nullable();
             $table->decimal('prepay_percent',8,2)->nullable();

            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('provider_id')->nullable();
                   $table->unsignedInteger('country_id')->nullable();
        $table->unsignedInteger('city_id')->nullable();
        
     $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();
        $table->tinyInteger('status')->dafault(1);

       $table->softDeletes();
        $table->timestamps();

        $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('city_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

$table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onDelete('cascade')->onUpdate('cascade');

       

    });

//services prices

        Schema::create($this->module_prefix . 'services_prices', function (Blueprint $table) {

            $table->increments('id');
            
   
        $table->boolean('is_class_price')->default(0);
        $table->integer('user_num')->nullable(); //Passengers
        $table->integer('total_cost')->nullable();
        $table->integer('total_price')->nullable();
        $table->integer('adult_numbers')->nullable();
        $table->integer('child_numbers')->nullable();
        $table->integer('infant_numbers')->nullable();
        $table->decimal('adult_price', 8,2)->nullable();
        $table->decimal('child_price', 8,2)->nullable();
        $table->decimal('infant_price', 8,2)->nullable();
        $table->decimal('adult_cost', 8,2)->nullable();
        $table->decimal('child_cost', 8,2)->nullable();
        $table->decimal('infant_cost', 8,2)->nullable();
       
        $table->string('booking_code')->unique()->nullable();
        $table->string('reserve_code')->nullable();
        $table->string('confirmed_reserve_code')->nullable();
        $table->text('booking_notes')->nullable();
        $table->text('provider_notes')->nullable();  

        $table->unsignedInteger('provider_id')->nullable();
        $table->unsignedInteger('service_id')->nullable();



        $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();

        $table->tinyInteger('status')->dafault(1);
            //0 => pending, 1 => active, 2 => canceled

        $table->softDeletes();
        $table->timestamps();
                    $table->decimal('currency_rate')->nullable(); //for company Main currency
            $table->unsignedInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('cascade')->onUpdate('cascade');

                    $table->unsignedInteger('branch_id')->nullable();


            $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');



        $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        
        $table->foreign('service_id')->references('id')->on($this->module_prefix.'services')->onDelete('cascade')->onUpdate('cascade');

        });


//services orders
Schema::create($this->module_prefix . 'services_orders', function (Blueprint $table) {
    $table->increments('id');
    $table->boolean('is_template')->default(0);
    $table->integer('order_day')->nullable();
    $table->dateTime('leave_time')->nullable();
    $table->date('due_date')->nullable();
        $table->boolean('is_class_price')->default(0);
        $table->integer('user_num')->nullable(); //Passengers
        $table->integer('total_cost')->nullable();
        $table->integer('total_price')->nullable();
        $table->integer('adult_numbers')->nullable();
        $table->integer('child_numbers')->nullable();
        $table->integer('infant_numbers')->nullable();
        $table->decimal('adult_price', 8,2)->nullable();
        $table->decimal('child_price', 8,2)->nullable();
        $table->decimal('infant_price', 8,2)->nullable();
        $table->decimal('adult_cost', 8,2)->nullable();
        $table->decimal('child_cost', 8,2)->nullable();
        $table->decimal('infant_cost', 8,2)->nullable();
       
        $table->string('price_type')->nullable(); //manual
        $table->decimal('prepay_percent',8,2)->nullable();
        $table->string('booking_code')->unique()->nullable();
        $table->string('reserve_code')->nullable();
        $table->string('confirmed_reserve_code')->nullable();
        $table->text('booking_notes')->nullable();
        $table->text('provider_notes')->nullable();  
        $table->decimal('branch_currency_rate')->nullable();
        $table->decimal('company_currency_rate')->nullable();
        $table->decimal('fees_percent',8,2)->nullable();
        $table->decimal('taxes_percent',8,2)->nullable();
        $table->unsignedInteger('value_currency_id')->nullable();
        $table->unsignedInteger('branch_currency_id')->nullable();
        $table->unsignedInteger('company_currency_id')->nullable();
        $table->unsignedInteger('provider_id')->nullable();
        $table->unsignedInteger('service_id')->nullable();

        $table->unsignedInteger('country_id')->nullable();
        $table->unsignedInteger('city_id')->nullable();
        
        $table->unsignedInteger('order_id')->nullable();
        $table->unsignedInteger('service_price_id')->nullable();

        $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();


        $table->tinyInteger('status')->dafault(1);
            //0 => pending, 1 => active, 2 => canceled

        $table->softDeletes();
        $table->timestamps();

                    $table->unsignedInteger('branch_id')->nullable();


            $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');



        $table->unsignedInteger('taxes_id')->nullable();
        $table->unsignedInteger('fees_id')->nullable();


        $table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');


        $table->foreign('value_currency_id', 'serval_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('branch_currency_id', 'serbr_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('company_currency_id', 'sercom_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');



        $table->foreign('order_id')->references('id')->on($this->module_prefix .'orders')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('city_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
       
        $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

         $table->foreign('service_id')->references('id')->on($this->module_prefix.'services')->onDelete('cascade')->onUpdate('cascade');

        
        $table->foreign('service_price_id')->references('id')->on($this->module_prefix.'services_prices')->onDelete('set null')->onUpdate('cascade');
       

    });


 

     //accounts
Schema::create($this->module_prefix . 'accounts', function (Blueprint $table) {
    $table->increments('id');
    $table->text('name')->nullable();
    $table->text('name_en')->nullable();
    $table->text('translated_name')->nullable();
    $table->decimal('balance', 11, 2)->default(0.00)->nullable();
    $table->decimal('opening_balance', 11, 2)->default(0.00)->nullable();
    $table->string('account_code')->unique();
    $table->string('box_number')->nullable(); //box or bank
    $table->string('condition'->default('both'); //, ['credit', 'debit', 'both'])
            $table->string('account_type')->dafault('box'); //, ['bank', 'box', 'other']
            $table->longText('description')->nullable();
            $table->text('notes')->nullable();
            $table->text('options')->nullable();
            $table->tinyInteger('status')->dafault(1);
            //0 => pending, 1 => active, 2 => canceled
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->unsignedInteger('currency_id')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on( 'users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on($this->module_prefix . 'branches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on($this->module_prefix.'currencies')->onDelete('cascade')->onUpdate('cascade');



        });




        //payments financial transfers

Schema::create($this->module_prefix . 'financials', function (Blueprint $table) {

    $table->increments('id');
    $table->string('code')->unique();
    $table->string('type')->nullable(); //, ['deposit', 'withdrawal', 'transfer', 'refund', 'commission', 'booking', 'other']
    $table->string('math_type')->nullable(); //, ['plus', 'minus', 'balanced']
        $table->string('item_type')->nullable(); //booking room, commission tour etc .. .
        $table->decimal('value', 11, 2)->default(0.00)->nullable();


        $table->integer('item_numbers')->default(1)->nullable();
        $table->text('description')->nullable();
        $table->text('notes')->nullable();
        $table->decimal('branch_currency_rate')->nullable();
        $table->decimal('company_currency_rate')->nullable();
        $table->tinyInteger('status')->dafault(1);
            //0 => pending, 1 => active, 2 => canceled [refund]



        $table->decimal('fees_percent',8,2)->nullable();
        $table->decimal('taxes_percent',8,2)->nullable();

        $table->softDeletes();
        $table->timestamps();

        $table->unsignedInteger('taxes_id')->nullable();
        $table->unsignedInteger('fees_id')->nullable();

        $table->unsignedInteger('parent_id')->nullable();

        $table->unsignedInteger('branch_id')->nullable();

        $table->unsignedInteger('order_id')->nullable();
        $table->unsignedInteger('to_user_id')->nullable();
        $table->unsignedInteger('from_user_id')->nullable();
        $table->unsignedInteger('to_account_id')->nullable();
        $table->unsignedInteger('from_account_id')->nullable();
        //currency_id => withdrawal or deposit amoun currency.
        $table->unsignedInteger('category_id')->nullable();
        $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();

        $table->unsignedInteger('value_currency_id')->nullable();
        $table->unsignedInteger('branch_currency_id')->nullable();
        $table->unsignedInteger('company_currency_id')->nullable();

        $table->foreign('value_currency_id', 'fin_val_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('branch_currency_id', 'fin_br_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('company_currency_id', 'fin_com_cur_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('branch_id')->references('id')->on($this->module_prefix.'branches')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'financials')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('to_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('to_account_id')->references('id')->on($this->module_prefix . 'accounts')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_account_id')->references('id')->on($this->module_prefix . 'accounts')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('order_id')->references('id')->on($this->module_prefix . 'orders')->onDelete('cascade')->onUpdate('cascade');


    });
//user_companions

    Schema::create($this->module_prefix . 'user_companions', function (Blueprint $table) {

    $table->increments('id');
    $table->text('name')->nullable();
    $table->text('notes')->nullable();
        $table->string('relation_type')->nullable(); //relation with parent user
        $table->string('gender')->nullable();
        $table->string('age')->nullable();
        $table->string('age_level')->nullable();
        $table->date('birth_date')->nullable();
        $table->unsignedInteger('nationality_id')->nullable();
        $table->unsignedInteger('parent_id')->nullable();
        $table->unsignedInteger('order_id')->nullable();
        $table->boolean('status')->default(1)->nullable();
        $table->unsignedInteger('created_by')->nullable();
        $table->unsignedInteger('updated_by')->nullable();
        $table->timestamps();
        $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('order_id')->references('id')->on($this->module_prefix . 'orders')->onDelete('cascade')->onUpdate('cascade');

    });



}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists($this->module_prefix.'user_companions');

        Schema::dropIfExists($this->module_prefix.'financials');
        Schema::dropIfExists($this->module_prefix.'accounts');

        Schema::dropIfExists($this->module_prefix.'services_orders');
        Schema::dropIfExists($this->module_prefix.'services_prices');
        Schema::dropIfExists($this->module_prefix.'services');

        Schema::dropIfExists($this->module_prefix.'transportations_orders');
        Schema::dropIfExists($this->module_prefix.'public_transports_orders');
        Schema::dropIfExists($this->module_prefix.'hotel_orders');
        Schema::dropIfExists($this->module_prefix.'orders');
        Schema::dropIfExists($this->module_prefix.'journey');
        
        Schema::dropIfExists($this->module_prefix.'airports');
        Schema::dropIfExists($this->module_prefix.'bus_stations');
        Schema::dropIfExists($this->module_prefix.'public_transports_prices');
        Schema::dropIfExists($this->module_prefix.'public_transports');
        Schema::dropIfExists($this->module_prefix.'hotel_prices_dates');
        Schema::dropIfExists($this->module_prefix.'hotel_prices_days');
        Schema::dropIfExists($this->module_prefix.'days');
        Schema::dropIfExists($this->module_prefix.'hotel_prices');
        
        
        Schema::dropIfExists($this->module_prefix.'bus_stations');
        Schema::dropIfExists($this->module_prefix.'public_transports_prices');
        Schema::dropIfExists($this->module_prefix.'public_transports');
        Schema::dropIfExists($this->module_prefix.'hotel_prices_dates');
        Schema::dropIfExists($this->module_prefix.'hotel_prices_days');
        Schema::dropIfExists($this->module_prefix.'days');
        Schema::dropIfExists($this->module_prefix.'hotel_prices');
        Schema::dropIfExists($this->module_prefix.'years');
        Schema::dropIfExists($this->module_prefix.'transport_prices_vehicles');
       
        Schema::dropIfExists($this->module_prefix.'transport_prices');
         Schema::dropIfExists($this->module_prefix.'vehicles');
        Schema::dropIfExists($this->module_prefix.'drivers');

        Schema::dropIfExists($this->module_prefix.'travels');

       
        Schema::dropIfExists($this->module_prefix.'rooms');
        Schema::dropIfExists($this->module_prefix.'hotels');

        Schema::dropIfExists($this->module_prefix.'places');

        
        Schema::dropIfExists($this->module_prefix . 'fees_values');
                Schema::dropIfExists($this->module_prefix.'fees');


        Schema::dropIfExists($this->module_prefix.'categoriables');
        Schema::dropIfExists($this->module_prefix.'categories');
        Schema::dropIfExists($this->module_prefix.'branches');
        Schema::dropIfExists($this->module_prefix.'cities');
        Schema::dropIfExists($this->module_prefix.'countries');
        Schema::dropIfExists($this->module_prefix.'currencies_rates');
        Schema::dropIfExists($this->module_prefix.'currencies');
        
    }
}
