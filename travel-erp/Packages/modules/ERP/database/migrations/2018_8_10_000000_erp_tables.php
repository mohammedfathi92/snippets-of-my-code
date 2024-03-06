<?php

namespace Packages\Modules\ERP\database\migrations;

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
            $table->string('exchange_rate');
            $table->boolean('as_main')->default(false)->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        // currencies rates
        Schema::create($this->module_prefix .'currencies_rates', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('rate');
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
            $table->timestamps();
            $table->softDeletes();
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
            $table->integer('rooms_num')->default(1)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('place_type')->nullable(); //from - to - both

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
            $table->increments('id');
            $table->string($this->module_prefix . 'categoriable_type');
            $table->unsignedInteger($this->module_prefix . 'categoriable_id');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('cascade')->onUpdate('cascade');
        });


        //supervisorables


        Schema::create($this->module_prefix . 'supervisors', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('roles')->nullable();
            $table->longText('permissions')->nullable();
            $table->string('supervisorable_type');
            $table->unsignedInteger('supervisorable_id');
            $table->longText('options')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
                $table->unsignedInteger('created_by')->nullable()->index();
    $table->unsignedInteger('updated_by')->nullable()->index();
    $table->timestamps();
    $table->softDeletes();
        });


        //fees & taxes


        Schema::create($this->module_prefix .'fees', function (Blueprint $table) {

            $table->increments('id');
            $table->text('name');
    $table->string('general_type')->nullable(); //ex. for all hotels
    $table->string('feesable_type')->nullable(); //ex. erp_hotel
    $table->unsignedInteger('feesable_id')->nullable(); //ex. id=1
    $table->enum('type', ['fee', 'tax'])->default('tax');
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
            $table->enum('value_type',['fixed', 'percent'])->default('percent');
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
            $table->decimal('service_fees',8,4)->nullable(); //fees
            $table->text('primary_phone')->nullable();
            $table->text('phone_one')->nullable();
            $table->text('phone_two')->nullable();
            $table->text('phone_three')->nullable();
            $table->text('fax_number')->nullable();
            $table->text('website_link')->nullable();
            $table->string('email')->nullable(); 
            // $table->enum('place_type', ['tourist', 'location'])->default('tourist')->nullable();   
            $table->longText('description')->nullable();
            $table->text('notes')->nullable();
            $table->string('reg_code')->unique()->nullable();
            $table->decimal('price',8,2)->nullable();
            $table->decimal('new_price',8,2)->nullable();  
            $table->decimal('season_price',8,2)->nullable();
            $table->integer('place_level')->nullable()->defaut(1);
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('map_location')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('set null')->onUpdate('cascade');

            $table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');



        });



        // hotels

        Schema::create($this->module_prefix . 'hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->decimal('service_fees',8,4)->nullable(); //fees
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
            $table->string('hotel_link')->nullable();   
            $table->string('website_link')->nullable();
            $table->text('video_code')->nullable();
            $table->string('reg_code')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('map_location')->nullable();
            $table->integer('hotel_level')->defaut(1)->nullable();
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
            $table->decimal('new_price',8,2)->nullable(); //sale price 
            $table->decimal('season_price',8,2)->nullable();
            $table->string('reg_code')->unique()->nullable();
            $table->text('video_code')->nullable();
            $table->integer('rooms_num')->default(0);
            $table->integer('beds_num')->default(0);
            
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

        Schema::create($this->module_prefix . 'tours', function (Blueprint $table) {
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

         // journey

        Schema::create($this->module_prefix . 'journeys', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();

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
        Schema::create($this->module_prefix . 'drivers_salaries', function (Blueprint $table) {
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
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('driver_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->tinyInteger('status')->dafault(0);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onDelete('cascade')->onUpdate('cascade');
        });

        // transport prices

        Schema::create($this->module_prefix . 'transport_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('reg_code')->unique()->nullable();  
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('discount_value')->nullable();

            $table->unsignedInteger('provider_id')->nullable();
            $table->unsignedInteger('from_country_id')->nullable();
            $table->unsignedInteger('to_country_id')->nullable();
            $table->unsignedInteger('from_city_id')->nullable();
            $table->unsignedInteger('to_city_id')->nullable();
            $table->string('sourcable_type')->nullable();
            $table->unsignedInteger('sourcable_id')->nullable();
            $table->string('targetable_type')->nullable();
            $table->unsignedInteger('targetable_id')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->string('currency_rate')->nullable(); //for company Main currency
            $table->unsignedInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('from_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');


        });

        // transport prices vehicles

        Schema::create($this->module_prefix . 'transport_vehicles_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('commission_one',8,3)->nullable();
            $table->decimal('commission_two',8,3)->nullable();
            $table->decimal('commission_three',8,3)->nullable();
            $table->string('discount_value')->nullable();
            $table->integer('hour_price')->nullable();
            $table->integer('hour_cost')->nullable();

            $table->decimal('cost',8,3)->nullable();
            $table->decimal('price',8,3)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('price_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('vehicle_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('price_id')->references('id')->on($this->module_prefix .'transport_prices')->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vehicle_id')->references('id')->on($this->module_prefix .'vehicles')->onDelete('cascade')->onUpdate('cascade');



        });


    // seasons 

        Schema::create($this->module_prefix . 'seasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year');
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

        });




        //hotel room pricing details

        Schema::create($this->module_prefix . 'hotel_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->decimal('price',8,4)->nullable();
            $table->decimal('cost',8,4)->nullable();
            $table->text('price_days')->nullable();
            $table->text('notes')->nullable();
            $table->string('discount_value')->nullable();

            $table->string('reg_code')->unique()->nullable(); 
            $table->string('r_code')->nullable();
            $table->string('s_code')->nullable();
            $table->integer('season')->nullable();
            $table->integer('max_extra_beds')->nullable();
            $table->decimal('extra_bed_price',8,2)->nullable(); //per one bed
            $table->decimal('extra_bed_cost',8,2)->nullable(); //per one bed
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_promo')->nullable()->default(true);
            $table->unsignedInteger('provider_id')->nullable();
            $table->unsignedInteger('season_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('hotel_id')->nullable();
            $table->unsignedInteger('room_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->tinyInteger('status')->dafault(0);

            $table->softDeletes();
            $table->timestamps();
            $table->string('currency_rate')->nullable(); //for company Main currency
            $table->unsignedInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('branch_id')->nullable();
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('season_id')->references('id')->on($this->module_prefix .'seasons')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('hotel_id')->references('id')->on($this->module_prefix .'hotels')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('room_id')->references('id')->on($this->module_prefix .'rooms')->onDelete('cascade')->onUpdate('cascade');



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


        // ferries, airlines, buses

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
            $table->text('address')->nullable();
            $table->string('email')->nullable(); 
            $table->decimal('service_fees',8,4)->nullable(); //fees
            $table->string('transport_type')->default('airline');
            $table->string('transport_code')->nullable(); //like line code   
            $table->string('reg_code')->unique()->nullable();  
            $table->decimal('transport_cost',8,2)->nullable();
            $table->decimal('sale_transport_cost',8,2)->nullable();

            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            


            $table->unsignedInteger('provider_id')->nullable();   
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->tinyInteger('status')->dafault(0);

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onDelete('set null')->onUpdate('cascade');



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
            $table->tinyInteger('status')->dafault(0);
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
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->tinyInteger('status')->dafault(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');



        });


          // flights prices

        Schema::create($this->module_prefix . 'flights_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('reg_code')->unique()->nullable();
            $table->text('notes')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('discount_value')->nullable();


            $table->decimal('cost_adult',8,2)->nullable();
            $table->decimal('price_adult',8,2)->nullable();
            $table->decimal('cost_child',8,2)->nullable();
            $table->decimal('price_child',8,2)->nullable();
            $table->decimal('cost_infant',8,2)->nullable();
            $table->decimal('price_infant',8,2)->nullable();
            $table->decimal('baggage_cost',8,2)->nullable(); //per kg
            $table->decimal('baggage_price',8,2)->nullable();
            $table->unsignedInteger('provider_id')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('from_country_id')->nullable();
            $table->unsignedInteger('airline_id')->nullable();
            $table->unsignedInteger('to_country_id')->nullable();
            $table->unsignedInteger('from_city_id')->nullable();
            $table->unsignedInteger('to_city_id')->nullable();

            $table->unsignedInteger('from_airport_id')->nullable();
            $table->unsignedInteger('to_airport_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->tinyInteger('status')->dafault(0);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('currency_rate')->nullable(); //for company Main currency
            $table->unsignedInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');


            $table->foreign('airline_id')->references('id')->on($this->module_prefix .'public_transports')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('from_airport_id')->references('id')->on($this->module_prefix .'airports')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('to_airport_id')->references('id')->on($this->module_prefix .'airports')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('from_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        });


    // ferries prices prices

        Schema::create($this->module_prefix . 'ferries_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('reg_code')->unique()->nullable();
            $table->text('notes')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('discount_value')->nullable();

            $table->decimal('passenger_price',8,2)->nullable();
            $table->decimal('passenger_cost',8,2)->nullable();
            $table->decimal('cost_adult',8,2)->nullable();
            $table->decimal('price_adult',8,2)->nullable();
            $table->decimal('cost_child',8,2)->nullable();
            $table->decimal('price_child',8,2)->nullable();
            $table->decimal('cost_infant',8,2)->nullable();
            $table->decimal('price_infant',8,2)->nullable();
            $table->decimal('baggage_cost',8,2)->nullable(); //per kg
            $table->decimal('baggage_price',8,2)->nullable();
            $table->unsignedInteger('provider_id')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('transport_id')->nullable();
            $table->unsignedInteger('from_country_id')->nullable();
            $table->unsignedInteger('to_country_id')->nullable();
            $table->unsignedInteger('from_city_id')->nullable();
            $table->unsignedInteger('to_city_id')->nullable();

            $table->unsignedInteger('from_place_id')->nullable();
            $table->unsignedInteger('to_place_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->tinyInteger('status')->dafault(0);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('currency_rate')->nullable(); //for company Main currency
            $table->unsignedInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');


            $table->foreign('transport_id')->references('id')->on($this->module_prefix .'public_transports')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('from_place_id')->references('id')->on($this->module_prefix .'places')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('to_place_id')->references('id')->on($this->module_prefix .'places')->onDelete('cascade')->onUpdate('cascade');


            $table->foreign('from_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        });

        // bus prices prices

        Schema::create($this->module_prefix . 'buses_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('reg_code')->unique()->nullable();
            $table->text('notes')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('discount_value')->nullable();

            $table->decimal('passenger_price',8,2)->nullable();
            $table->decimal('passenger_cost',8,2)->nullable();
            $table->decimal('cost_adult',8,2)->nullable();
            $table->decimal('price_adult',8,2)->nullable();
            $table->decimal('cost_child',8,2)->nullable();
            $table->decimal('price_child',8,2)->nullable();
            $table->decimal('cost_infant',8,2)->nullable();
            $table->decimal('price_infant',8,2)->nullable();
            $table->decimal('baggage_cost',8,2)->nullable(); //per kg
            $table->decimal('baggage_price',8,2)->nullable();
            $table->unsignedInteger('provider_id')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('transport_id')->nullable();
            $table->unsignedInteger('from_country_id')->nullable();
            $table->unsignedInteger('to_country_id')->nullable();
            $table->unsignedInteger('from_city_id')->nullable();
            $table->unsignedInteger('to_city_id')->nullable();
            $table->string('sourcable_type')->nullable();
            $table->unsignedInteger('sourcable_id')->nullable();
            $table->string('targetable_type')->nullable();
            $table->unsignedInteger('targetable_id')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->tinyInteger('status')->dafault(0);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('currency_rate')->nullable(); //for company Main currency
            $table->unsignedInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');


            $table->foreign('transport_id')->references('id')->on($this->module_prefix .'public_transports')->onDelete('cascade')->onUpdate('cascade');


            $table->foreign('to_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        });


        // additional activities

        Schema::create($this->module_prefix . 'activities', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->string('reg_code')->unique()->nullable();
            
            $table->integer('quantity')->nullable();
            $table->longText('description')->nullable();
            $table->longText('notes')->nullable();
            $table->text('address')->nullable();
            $table->text('map_location')->nullable();
            $table->text('fax_number')->nullable();
            $table->text('primary_phone')->nullable();
            $table->text('phone_one')->nullable();
            $table->text('phone_two')->nullable();
            $table->text('phone_three')->nullable();
            $table->text('email')->nullable();
            $table->text('website_link')->nullable();
            $table->decimal('prepay_percent',8,2)->nullable();
             $table->decimal('service_fees',8,4)->nullable(); //fees

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

// additional services

        Schema::create($this->module_prefix . 'services', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->string('reg_code')->unique()->nullable();

            $table->integer('quantity')->nullable();
            $table->longText('description')->nullable();
            $table->longText('notes')->nullable();
            $table->text('address')->nullable();
            $table->text('map_location')->nullable();
            $table->text('fax_number')->nullable();
            $table->text('primary_phone')->nullable();
            $table->text('phone_one')->nullable();
            $table->text('phone_two')->nullable();
            $table->text('phone_three')->nullable();
            $table->text('email')->nullable();
            $table->text('website_link')->nullable();
            $table->decimal('prepay_percent',8,2)->nullable();
             $table->decimal('service_fees',8,4)->nullable(); //fees

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

//activities prices

        Schema::create($this->module_prefix . 'activities_prices', function (Blueprint $table) {

            $table->increments('id');
            $table->text('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('notes')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            
            $table->boolean('is_class_price')->default(0);
        $table->integer('user_num')->nullable(); //Passengers
        $table->integer('quantity')->nullable();
        $table->string('discount_value')->nullable();


        $table->decimal('cost_adult',8,2)->nullable();
        $table->decimal('price_adult',8,2)->nullable();
        $table->decimal('cost_child',8,2)->nullable();
        $table->decimal('price_child',8,2)->nullable();
        $table->decimal('cost_infant',8,2)->nullable();
        $table->decimal('price_infant',8,2)->nullable();

        $table->string('booking_code')->unique()->nullable();
        $table->string('reserve_code')->nullable();
        $table->string('confirmed_reserve_code')->nullable();
        $table->text('booking_notes')->nullable();
        $table->text('provider_notes')->nullable();  

        $table->unsignedInteger('provider_id')->nullable();
        $table->unsignedInteger('activity_id')->nullable();

        $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();
        $table->tinyInteger('status')->dafault(1);
            //0 => pending, 1 => active, 2 => canceled
        $table->softDeletes();
        $table->timestamps();
        $table->string('currency_rate')->nullable(); //for company Main currency
        $table->unsignedInteger('currency_id')->nullable();
        $table->unsignedInteger('country_id')->nullable();
        $table->unsignedInteger('city_id')->nullable();
        $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('cascade')->onUpdate('cascade');
        $table->unsignedInteger('branch_id')->nullable();
        $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('activity_id')->references('id')->on($this->module_prefix.'activities')->onDelete('cascade')->onUpdate('cascade');

    });


    //services prices

        Schema::create($this->module_prefix . 'services_prices', function (Blueprint $table) {

            $table->increments('id');

            $table->text('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('notes')->nullable();
            $table->string('discount_value')->nullable();


            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            
            $table->boolean('is_class_price')->default(0);
        $table->integer('user_num')->nullable(); //Passengers
        $table->integer('quantity')->nullable();
        $table->decimal('price', 8,2)->nullable(); //per service
        $table->decimal('cost', 8,2)->nullable(); //per service

        $table->integer('total_cost')->nullable();
        $table->integer('total_price')->nullable();

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
        $table->string('currency_rate')->nullable(); //for company Main currency

        $table->unsignedInteger('currency_id')->nullable();
        $table->unsignedInteger('country_id')->nullable();
        $table->unsignedInteger('city_id')->nullable();
        $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('cascade')->onUpdate('cascade');

        $table->unsignedInteger('branch_id')->nullable();


        $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');



        $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        
        $table->foreign('service_id')->references('id')->on($this->module_prefix.'services')->onDelete('cascade')->onUpdate('cascade');

    });




      // orders

        Schema::create($this->module_prefix . 'orders', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->string('reg_code')->unique()->nullable();
            $table->string('package_code')->unique()->nullable();
            $table->decimal('prepay_percent',8,2)->nullable();
            $table->decimal('total_amount',8,2)->nullable();
            $table->string('payment_status')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->boolean('is_template')->nullable()->default(0);
        $table->integer('last_step')->nullable(); //in day
        $table->integer('duration'); //in day
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();
        $table->date('order_date')->nullable();
        $table->date('arrive_date')->nullable();
        $table->dateTime('arrive_time')->nullable();
        $table->text('order_notes')->nullable();
        $table->text('order_includings_note')->nullable();

        $table->string('discount_value')->nullable();
        $table->string('hotels_discount')->nullable();
        $table->string('transports_discount')->nullable();
        $table->string('ferries_discount')->nullable();
        $table->string('flights_discount')->nullable();
        $table->string('buses_discount')->nullable();
        $table->string('activities_discount')->nullable();
        $table->string('services_discount')->nullable();

        $table->integer('adult_numbers')->default(0)->nullable();
        $table->integer('child_numbers')->default(0)->nullable();
        $table->integer('infant_numbers')->default(0)->nullable();
        $table->text('agent_notes')->nullable();
        $table->text('promoter_notes')->nullable();
        $table->string('main_currency_rate')->nullable();
        $table->string('auto_currency_rate')->nullable();
        $table->string('manual_currency_rate')->nullable();
        $table->softDeletes();
        $table->timestamps();

        $table->unsignedInteger('customer_id')->nullable()->index();
        $table->unsignedInteger('agent_id')->nullable();
        $table->unsignedInteger('promoter_id')->nullable();
        $table->unsignedInteger('category_id')->nullable();
        $table->unsignedInteger('purpose_id')->nullable();
        $table->unsignedInteger('referred_by_id')->nullable();
        $table->unsignedInteger('destination_id')->nullable();

        $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();


        $table->unsignedInteger('main_currency_id')->nullable();
        $table->unsignedInteger('currency_id')->nullable();

        $table->unsignedInteger('branch_id')->nullable();


        $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('main_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        
        $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('agent_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('promoter_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('destination_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('purpose_id')->references('id')->on($this->module_prefix .'categories')->onUpdate('cascade')->onDelete('set null');
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
    $table->decimal('room_cost',8,2)->nullable();
    $table->decimal('auto_room_price',8,2)->nullable();
    $table->enum('room_price_type', ['manual', 'auto'])->default('manual')->nullable();
    $table->text('auto_prices')->nullable();

    $table->decimal('prepay_percent',8,2)->nullable();
    $table->integer('nights')->nullable();
    $table->string('booking_code')->unique()->nullable();

    $table->string('reg_code')->unique()->nullable();
    $table->string('reserve_code')->nullable();
    $table->string('confirmed_reserve_code')->nullable();
    $table->string('discount_value')->nullable();


    $table->dateTime('checkin')->nullable();
    $table->dateTime('checkout')->nullable();
    $table->tinyInteger('breakfast')->dafault(0);
    $table->date('due_date')->nullable();
    $table->integer('extra_beds')->nullable();
            $table->decimal('extra_bed_price',8,2)->nullable(); //per one bed
             $table->decimal('extra_bed_cost',8,2)->nullable(); //per one bed
             $table->decimal('auto_extra_bed_price',8,2)->nullable();
             $table->text('provider_notes')->nullable();
             $table->text('order_notes')->nullable();
             $table->enum('paymeny_status',['pending', 'paid', 'canceled'])->default('pending');
        $table->tinyInteger('status')->nullable()->dafault(0); //payment_status
        $table->decimal('total_price',8,2)->nullable();
        $table->decimal('fees_percent',8,2)->nullable();
        $table->decimal('taxes_percent',8,2)->nullable();

        $table->unsignedInteger('country_id')->nullable();
        $table->unsignedInteger('city_id')->nullable();
        $table->unsignedInteger('taxes_id')->nullable();
        $table->unsignedInteger('fees_id')->nullable();
        $table->unsignedInteger('provider_id')->nullable();
        

        $table->unsignedInteger('hotel_price_id')->nullable();

        $table->unsignedInteger('hotel_id')->nullable();
        $table->unsignedInteger('room_id')->nullable(); 
        $table->unsignedInteger('season_id')->nullable();

        $table->unsignedInteger('order_id');

        $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();
        $table->softDeletes();
        $table->timestamps();


        $table->unsignedInteger('branch_id')->nullable();

        $table->string('main_currency_rate')->nullable(); //[company] for dollar
        $table->string('old_currency_rate')->nullable(); //[hotel]for main
        $table->string('new_currency_rate')->nullable(); //[hotel]for main
        $table->unsignedInteger('main_currency_id')->nullable();
        $table->unsignedInteger('old_currency_id')->nullable();
        $table->unsignedInteger('new_currency_id')->nullable();
        $table->foreign('main_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('old_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('new_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');




        $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');


        



        $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('order_id')->references('id')->on($this->module_prefix .'orders')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('provider_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('hotel_id')->references('id')->on($this->module_prefix .'hotels')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('hotel_price_id')->references('id')->on($this->module_prefix .'hotel_prices')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('room_id')->references('id')->on($this->module_prefix .'rooms')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('season_id')->references('id')->on($this->module_prefix .'seasons')->onUpdate('cascade')->onDelete('set null');


    });

      // flight_orders

Schema::create($this->module_prefix . 'flights_orders', function (Blueprint $table) {
    $table->increments('id');
    $table->boolean('is_template')->default(0);
     $table->string('transport_type')->nullable(); //ferry or flight

     $table->integer('order_day')->nullable();
     $table->date('leave_date')->nullable();
     $table->date('arrive_date')->nullable();
     $table->dateTime('leave_time')->nullable();
     $table->dateTime('arrive_time')->nullable();
     $table->date('due_date')->nullable();
     $table->enum('price_type', ['manual', 'auto'])->default('manual')->nullable();
     $table->string('discount_value')->nullable();

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

    $table->decimal('auto_adult_price', 8,2)->nullable();
    $table->decimal('auto_child_price', 8,2)->nullable();
    $table->decimal('auto_infant_price', 8,2)->nullable();
    $table->decimal('auto_adult_cost', 8,2)->nullable();
    $table->decimal('auto_child_cost', 8,2)->nullable();
    $table->decimal('auto_infant_cost', 8,2)->nullable();

    $table->decimal(' auto_baggage_price', 8,2)->nullable();
    $table->decimal(' auto_baggage_cost', 8,2)->nullable();


        $table->decimal('baggage_weight', 8,2)->nullable(); //in kg
        $table->decimal('baggage_cost', 8,2)->nullable();
        $table->decimal('baggage_price', 8,2)->nullable();
        $table->decimal('prepay_percent',8,2)->nullable();
        $table->string('booking_code')->unique()->nullable();
        $table->string('reserve_code')->nullable();
        $table->string('confirmed_reserve_code')->nullable();
        $table->text('booking_notes')->nullable();
        $table->text('provider_notes')->nullable();  

        $table->decimal('fees_percent',8,2)->nullable();
        $table->decimal('taxes_percent',8,2)->nullable();
        
        $table->unsignedInteger('provider_id')->nullable();
        $table->unsignedInteger('flight_price_id')->nullable();
        $table->unsignedInteger('airline_id')->nullable();
        $table->unsignedInteger('from_country_id')->nullable();
        $table->unsignedInteger('from_city_id')->nullable();
        $table->unsignedInteger('from_airport_id')->nullable();
        $table->unsignedInteger('to_country_id')->nullable();
        $table->unsignedInteger('to_city_id')->nullable();
        $table->unsignedInteger('to_airport_id')->nullable();
        $table->unsignedInteger('order_id');

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

        $table->string('main_currency_rate')->nullable(); //[company] for dollar
        $table->string('old_currency_rate')->nullable(); //[hotel]for main
        $table->string('new_currency_rate')->nullable(); //[hotel]for main
        $table->unsignedInteger('main_currency_id')->nullable();
        $table->unsignedInteger('old_currency_id')->nullable();
        $table->unsignedInteger('new_currency_id')->nullable();
        $table->foreign('main_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('old_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('new_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');


        $table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');



        $table->foreign('order_id')->references('id')->on($this->module_prefix .'orders')->onDelete('cascade')->onUpdate('cascade');
        
        $table->foreign('airline_id')->references('id')->on($this->module_prefix .'public_transports')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('from_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('to_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('to_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_airport_id')->references('id')->on($this->module_prefix .'airports')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('to_airport_id')->references('id')->on($this->module_prefix .'airports')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        
        $table->foreign('flight_price_id')->references('id')->on($this->module_prefix.'flights_prices', 'orderpub_trans_prices_id')->onDelete('cascade')->onUpdate('cascade');

    });


 // ferries_orders

Schema::create($this->module_prefix . 'ferries_orders', function (Blueprint $table) {
    $table->increments('id');
    $table->boolean('is_template')->default(0);
    
    $table->integer('order_day')->nullable();
    $table->date('leave_date')->nullable();

    $table->date('arrive_date')->nullable();
    $table->dateTime('leave_time')->nullable();
    $table->dateTime('arrive_time')->nullable();
    $table->date('due_date')->nullable();
        $table->string('transport_type')->nullable(); //ferry or flight
        $table->enum('price_type', ['manual', 'auto'])->default('manual')->nullable();
        $table->string('discount_value')->nullable();

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

        $table->decimal('auto_adult_price', 8,2)->nullable();
        $table->decimal('auto_child_price', 8,2)->nullable();
        $table->decimal('auto_infant_price', 8,2)->nullable();
        $table->decimal('auto_adult_cost', 8,2)->nullable();
        $table->decimal('auto_child_cost', 8,2)->nullable();
        $table->decimal('auto_infant_cost', 8,2)->nullable();

        $table->decimal(' auto_baggage_price', 8,2)->nullable();
        $table->decimal(' auto_baggage_cost', 8,2)->nullable();

        $table->decimal('baggage_weight', 8,2)->nullable(); //in kg
        $table->decimal('baggage_cost', 8,2)->nullable();
        $table->decimal('baggage_price', 8,2)->nullable();
        $table->decimal('prepay_percent',8,2)->nullable();
        $table->string('booking_code')->unique()->nullable();
        $table->string('reserve_code')->nullable();
        $table->string('confirmed_reserve_code')->nullable();
        $table->text('booking_notes')->nullable();
        $table->text('provider_notes')->nullable();  

        $table->decimal('fees_percent',8,2)->nullable();
        $table->decimal('taxes_percent',8,2)->nullable();
        
        $table->unsignedInteger('provider_id')->nullable();
        $table->unsignedInteger('transport_id')->nullable();
        $table->unsignedInteger('ferry_price_id')->nullable();
        $table->unsignedInteger('from_country_id')->nullable();
        $table->unsignedInteger('from_city_id')->nullable();
        $table->unsignedInteger('to_country_id')->nullable();
        $table->unsignedInteger('to_city_id')->nullable();
        $table->unsignedInteger('from_place_id')->nullable();
        $table->unsignedInteger('to_place_id')->nullable();
        $table->unsignedInteger('order_id');

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

        $table->string('main_currency_rate')->nullable(); //[company] for dollar
        $table->string('old_currency_rate')->nullable(); //[hotel]for main
        $table->string('new_currency_rate')->nullable(); //[hotel]for main
        $table->unsignedInteger('main_currency_id')->nullable();
        $table->unsignedInteger('old_currency_id')->nullable();
        $table->unsignedInteger('new_currency_id')->nullable();
        $table->foreign('main_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('old_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('new_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');


        $table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');



        $table->foreign('order_id')->references('id')->on($this->module_prefix .'orders')->onDelete('cascade')->onUpdate('cascade');
        
        $table->foreign('from_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('to_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_place_id')->references('id')->on($this->module_prefix .'places')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('to_place_id')->references('id')->on($this->module_prefix .'places')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('to_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        
        $table->foreign('ferry_price_id')->references('id')->on($this->module_prefix.'ferries_prices')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('transport_id')->references('id')->on($this->module_prefix.'public_transports')->onDelete('cascade')->onUpdate('cascade');

    });

  // buses_orders

Schema::create($this->module_prefix . 'buses_orders', function (Blueprint $table) {
    $table->increments('id');
    $table->boolean('is_template')->default(0);

    $table->integer('order_day')->nullable();
    $table->date('leave_date')->nullable();
    $table->date('arrive_date')->nullable();
    $table->dateTime('leave_time')->nullable();
    $table->dateTime('arrive_time')->nullable();
    $table->date('due_date')->nullable();
$table->string('transport_type')->nullable(); //ferry or flight
$table->string('discount_value')->nullable();

$table->enum('price_type', ['manual', 'auto'])->default('manual')->nullable();
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

$table->decimal('auto_adult_price', 8,2)->nullable();
$table->decimal('auto_child_price', 8,2)->nullable();
$table->decimal('auto_infant_price', 8,2)->nullable();
$table->decimal('auto_adult_cost', 8,2)->nullable();
$table->decimal('auto_child_cost', 8,2)->nullable();
$table->decimal('auto_infant_cost', 8,2)->nullable();

$table->decimal(' auto_baggage_price', 8,2)->nullable();
$table->decimal(' auto_baggage_cost', 8,2)->nullable();

$table->decimal('baggage_weight', 8,2)->nullable(); //in kg
$table->decimal('baggage_cost', 8,2)->nullable();
$table->decimal('baggage_price', 8,2)->nullable();
$table->decimal('prepay_percent',8,2)->nullable();
$table->string('booking_code')->unique()->nullable();
$table->string('reserve_code')->nullable();
$table->string('confirmed_reserve_code')->nullable();
$table->text('booking_notes')->nullable();
$table->text('provider_notes')->nullable();  

$table->decimal('fees_percent',8,2)->nullable();
$table->decimal('taxes_percent',8,2)->nullable();

$table->unsignedInteger('provider_id')->nullable();
$table->unsignedInteger('transport_id')->nullable();
$table->unsignedInteger('bus_price_id')->nullable();

$table->unsignedInteger('from_country_id')->nullable();
$table->unsignedInteger('from_city_id')->nullable();
$table->unsignedInteger('to_country_id')->nullable();
$table->unsignedInteger('to_city_id')->nullable();

$table->string('sourcable_type')->nullable();
$table->unsignedInteger('sourcable_id')->nullable();
$table->string('targetable_type')->nullable();
$table->unsignedInteger('targetable_id')->nullable();

$table->unsignedInteger('order_id');

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

$table->string('main_currency_rate')->nullable(); //[company] for dollar
$table->string('old_currency_rate')->nullable(); //[hotel]for main
$table->string('new_currency_rate')->nullable(); //[hotel]for main
$table->unsignedInteger('main_currency_id')->nullable();
$table->unsignedInteger('old_currency_id')->nullable();
$table->unsignedInteger('new_currency_id')->nullable();
$table->foreign('main_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
$table->foreign('old_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
$table->foreign('new_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');


$table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

$table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');



$table->foreign('order_id')->references('id')->on($this->module_prefix .'orders')->onDelete('cascade')->onUpdate('cascade');

$table->foreign('from_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
$table->foreign('to_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
$table->foreign('from_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');


$table->foreign('to_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
$table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
$table->foreign('bus_price_id')->references('id')->on($this->module_prefix.'buses_prices')->onDelete('cascade')->onUpdate('cascade');
$table->foreign('transport_id')->references('id')->on($this->module_prefix.'public_transports')->onDelete('cascade')->onUpdate('cascade');

});


    // transport_orders

Schema::create($this->module_prefix . 'transportations_orders', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('order_day')->nullable();
    $table->boolean('is_template')->default(0);
    $table->integer('passengers_num')->nullable();
    $table->integer('vehicles_num')->nullable();
    $table->decimal('hours_num',8,2)->nullable();
    $table->integer('hour_price')->nullable();
    $table->integer('hour_cost')->nullable();
    
    $table->decimal('vehicle_cost',8,2)->nullable(); //per vehicle & per hour
    $table->decimal('vehicle_price',8,2)->nullable(); //per hour
    $table->decimal('auto_vehicle_cost',8,2)->nullable(); //per vehicle
    $table->decimal('auto_vehicle_price',8,2)->nullable();
    $table->string('discount_value')->nullable();

    $table->enum('price_type', ['manual', 'auto'])->default('manual')->nullable();
    $table->text('order_notes')->nullable();
    $table->text('driver_notes')->nullable();
    $table->text('provider_notes')->nullable();
    $table->dateTime('leave_time')->nullable();
    $table->dateTime('arrive_time')->nullable();
    $table->date('leave_date')->nullable(); 
    $table->date('due_date')->nullable();
    $table->string('booking_code')->unique()->nullable();
    $table->string('reserve_code')->nullable(); //from provider
    $table->string('confirmed_reserve_code')->nullable();

    $table->decimal('fees_percent',8,2)->nullable();
    $table->decimal('taxes_percent',8,2)->nullable();
    $table->unsignedInteger('taxes_id')->nullable();
    $table->unsignedInteger('fees_id')->nullable();


    $table->unsignedInteger('from_country_id')->nullable();
    $table->unsignedInteger('to_country_id')->nullable();
    $table->unsignedInteger('from_city_id')->nullable();
    $table->unsignedInteger('to_city_id')->nullable();
    $table->string('sourcable_type')->nullable();
    $table->unsignedInteger('sourcable_id')->nullable();
    $table->string('targetable_type')->nullable();
    $table->unsignedInteger('targetable_id')->nullable();
    $table->unsignedInteger('vehicle_id')->nullable();
    $table->unsignedInteger('vehicle_type_id')->nullable();
    $table->unsignedInteger('driver_id')->nullable();
    $table->unsignedInteger('provider_id')->nullable();
    $table->unsignedInteger('transport_price_id')->nullable();
    
    
    $table->decimal('prepay_percent',8,2)->nullable();

    $table->text('sms_to_driver')->nullable();
    $table->text('sms_to_client')->nullable();
    $table->tinyInteger('status')->dafault(1);
            //0 => pending, 1 => active, 2 => canceled
    $table->unsignedInteger('order_id');
    $table->unsignedInteger('created_by')->nullable()->index();
    $table->unsignedInteger('updated_by')->nullable()->index();
    $table->softDeletes();
    $table->timestamps();

    $table->unsignedInteger('branch_id')->nullable();

                    $table->string('main_currency_rate')->nullable(); //[company] for dollar
        $table->string('old_currency_rate')->nullable(); //[hotel]for main
        $table->string('new_currency_rate')->nullable(); //[hotel]for main
        $table->unsignedInteger('main_currency_id')->nullable();
        $table->unsignedInteger('old_currency_id')->nullable();
        $table->unsignedInteger('new_currency_id')->nullable();
        $table->foreign('main_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('old_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('new_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');


        $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');


        $table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');




        $table->foreign('order_id')->references('id')->on($this->module_prefix .'orders')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('to_country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');


        $table->foreign('vehicle_type_id')->references('id')->on($this->module_prefix .'categories')->onDelete('cascade')->onUpdate('cascade');


        $table->foreign('from_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('to_city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('vehicle_id')->references('id')->on($this->module_prefix .'vehicles')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('transport_price_id')->references('id')->on($this->module_prefix .'transport_prices')->onDelete('set null')->onUpdate('cascade');

    });




//services orders
Schema::create($this->module_prefix . 'activities_orders', function (Blueprint $table) {
    $table->increments('id');
    $table->boolean('is_template')->default(0);
    $table->integer('order_day')->nullable();
    $table->date('start_date')->nullable();
    $table->dateTime('start_time')->nullable();
    $table->date('end_date')->nullable();
    $table->dateTime('end_time')->nullable();
    $table->date('due_date')->nullable();
    $table->string('discount_value')->nullable();
    $table->enum('price_type', ['manual', 'auto'])->default('manual')->nullable();
    $table->integer('quantity')->nullable();
    $table->text('auto_prices')->nullable();
    $table->boolean('is_class_price')->default(0);
        $table->integer('users_num')->nullable(); //Passengers
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

        $table->decimal('auto_adult_price', 8,2)->nullable();
        $table->decimal('auto_child_price', 8,2)->nullable();
        $table->decimal('auto_infant_price', 8,2)->nullable();
        $table->decimal('auto_adult_cost', 8,2)->nullable();
        $table->decimal('auto_child_cost', 8,2)->nullable();
        $table->decimal('auto_infant_cost', 8,2)->nullable();

        $table->decimal('prepay_percent',8,2)->nullable();
        $table->string('booking_code')->unique()->nullable();
        $table->string('reserve_code')->nullable();
        $table->string('confirmed_reserve_code')->nullable();
        $table->text('booking_notes')->nullable();
        $table->text('provider_notes')->nullable();  

        $table->decimal('fees_percent',8,2)->nullable();
        $table->decimal('taxes_percent',8,2)->nullable();

        $table->unsignedInteger('provider_id')->nullable();
        $table->unsignedInteger('activity_id')->nullable();

        $table->unsignedInteger('country_id')->nullable();
        $table->unsignedInteger('city_id')->nullable();
        
        $table->unsignedInteger('order_id');
        $table->unsignedInteger('activity_price_id')->nullable();

        $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();


        $table->tinyInteger('status')->dafault(1);
            //0 => pending, 1 => active, 2 => canceled

        $table->softDeletes();
        $table->timestamps();

        $table->unsignedInteger('branch_id')->nullable();

        $table->string('main_currency_rate')->nullable(); //[company] for dollar
        $table->string('old_currency_rate')->nullable(); //[hotel]for main
        $table->string('new_currency_rate')->nullable(); //[hotel]for main
        $table->unsignedInteger('main_currency_id')->nullable();
        $table->unsignedInteger('old_currency_id')->nullable();
        $table->unsignedInteger('new_currency_id')->nullable();
        $table->foreign('main_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('old_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('new_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');


        $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');



        $table->unsignedInteger('taxes_id')->nullable();
        $table->unsignedInteger('fees_id')->nullable();




        $table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');


        $table->foreign('order_id')->references('id')->on($this->module_prefix .'orders')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('city_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('activity_id')->references('id')->on($this->module_prefix.'activities')->onDelete('cascade')->onUpdate('cascade');

        
        $table->foreign('activity_price_id')->references('id')->on($this->module_prefix.'activities_prices')->onDelete('set null')->onUpdate('cascade');


    });



//services orders
Schema::create($this->module_prefix . 'services_orders', function (Blueprint $table) {
    $table->increments('id');
    $table->boolean('is_template')->default(0);
    $table->integer('order_day')->nullable();
    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();
    $table->dateTime('start_time')->nullable();
    $table->dateTime('end_time')->nullable();
    $table->date('due_date')->nullable();
    $table->string('discount_value')->nullable();

    $table->enum('price_type', ['manual', 'auto'])->default('manual')->nullable();
    $table->integer('quantity')->default(1)->nullable();
    $table->decimal('cost', 8,2)->nullable();

    $table->decimal('price', 8,2)->nullable();
    $table->decimal('auto_cost', 8,2)->nullable();

    $table->decimal('auto_price', 8,2)->nullable();
    $table->boolean('is_class_price')->default(0);
        $table->integer('users_num')->nullable(); //Passengers
        $table->decimal('total_cost', 8,2)->nullable();
        $table->decimal('total_price', 8,2)->nullable();

        $table->decimal('prepay_percent',8,2)->nullable();
        $table->string('booking_code')->unique()->nullable();
        $table->string('reserve_code')->nullable();
        $table->string('confirmed_reserve_code')->nullable();
        $table->text('booking_notes')->nullable();
        $table->text('provider_notes')->nullable();  

        $table->decimal('fees_percent',8,2)->nullable();
        $table->decimal('taxes_percent',8,2)->nullable();

        $table->unsignedInteger('provider_id')->nullable();
        $table->unsignedInteger('service_id')->nullable();

        $table->unsignedInteger('country_id')->nullable();
        $table->unsignedInteger('city_id')->nullable();
        
        $table->unsignedInteger('order_id');
        $table->unsignedInteger('service_price_id')->nullable();

        $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();


        $table->tinyInteger('status')->dafault(1);
            //0 => pending, 1 => active, 2 => canceled

        $table->softDeletes();
        $table->timestamps();

        $table->unsignedInteger('branch_id')->nullable();

        $table->string('main_currency_rate')->nullable(); //[company] for dollar
        $table->string('old_currency_rate')->nullable(); //[hotel]for main
        $table->string('new_currency_rate')->nullable(); //[hotel]for main
        $table->unsignedInteger('main_currency_id')->nullable();
        $table->unsignedInteger('old_currency_id')->nullable();
        $table->unsignedInteger('new_currency_id')->nullable();
        $table->foreign('main_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('old_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('new_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');


        $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');



        $table->unsignedInteger('taxes_id')->nullable();
        $table->unsignedInteger('fees_id')->nullable();




        $table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');


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
    $table->enum('condition', ['credit', 'debit', 'both'])->default('both');
            $table->enum('account_type', ['bank', 'box', 'other'])->dafault('box'); //
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
    $table->string('reg_code')->nullable()->unique();
    $table->string('refrence_code')->nullable();
    $table->string('type')->nullable(); //general type => ['deposit', 'withdrawal','cancel', 'transfer', 'refund', 'commission', 'booking','salary','other']
    $table->string('math_type')->nullable(); //['plus', 'minus', 'balanced']
        $table->string('sub_type')->nullable(); //booking room, commission tour etc .. . //sub type =>for orders only have two types ['Remaining premium', 'prepayment'];
        $table->string('order_payment_type')->nullable(); //booking room, commission tour etc .. . //sub type
        

        $table->string('value_type')->default('amount')->nullable(); //['amount', 'percent']
        $table->decimal('reg_value', 11, 4)->default(0.00)->nullable(); //20% or 300 $

        $table->decimal('final_value', 11, 4)->default(0.00);
        $table->boolean('is_primary')->default(0)->nullable();

        $table->integer('item_numbers')->default(1)->nullable();
        $table->text('description')->nullable();
        $table->text('notes')->nullable();
        $table->text('extra_update_reasons')->nullable();
        $table->boolean('is_hidden')->default(0)->nullable();

        $table->string('to_account_rate')->nullable(); //exchange rate => account that we make process to or from it
        $table->string('from_account_rate')->nullable(); //account that we make process to or from it


        $table->date('payment_date')->nullable();
        $table->dateTime('payment_time')->nullable();
        $table->string('value_currency_rate')->nullable();
        $table->string('old_currency_rate')->nullable();
        $table->string('main_currency_rate')->nullable();
        $table->string('parent_relation_type')->nullable(); //['plus', 'minus', 'balanced'] main ex. this record minus from parent record

        $table->tinyInteger('status')->dafault(1);
        //0 => pending, 1 => active, 2 => canceled [refund]
        $table->decimal('fees_percent',8,2)->nullable();
        $table->decimal('taxes_percent',8,2)->nullable();

        $table->softDeletes();
        $table->timestamps();

        $table->unsignedInteger('pay_method_id')->nullable();

        $table->unsignedInteger('taxes_id')->nullable();
        $table->unsignedInteger('fees_id')->nullable();

        $table->unsignedInteger('parent_id')->nullable();

        $table->unsignedInteger('branch_id')->nullable();

        $table->unsignedInteger('main_order_id')->nullable();
        $table->unsignedInteger('itemable_id')->nullable();
        $table->string('itemable_type')->nullable();
        $table->string('order_financial_type')->nullable(); //prepaid ... etc
        $table->unsignedInteger('to_user_id')->nullable();
        $table->unsignedInteger('from_user_id')->nullable();
        $table->unsignedInteger('to_account_id')->nullable();
        $table->unsignedInteger('from_account_id')->nullable();
        //currency_id => withdrawal or deposit amoun currency.
        $table->unsignedInteger('category_id')->nullable();
        $table->unsignedInteger('recipient_id')->nullable()->index(); //who take payment
        $table->unsignedInteger('staff_id')->nullable()->index();   //supervisor on process
        $table->unsignedInteger('created_by')->nullable()->index();
        $table->unsignedInteger('updated_by')->nullable()->index();

        $table->unsignedInteger('update_reason_id')->nullable();
         $table->unsignedInteger('value_currency_id')->nullable();
        $table->unsignedInteger('main_currency_id')->nullable();
         $table->unsignedInteger('to_account_currency_id')->nullable();
          $table->unsignedInteger('from_account_currency_id')->nullable();

        $table->unsignedInteger('from_account_cat_id')->nullable();
        $table->unsignedInteger('to_account_cat_id')->nullable();

        $table->foreign('value_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('main_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('pay_method_id')->references('id')->on($this->module_prefix.'categories')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('branch_id')->references('id')->on($this->module_prefix.'branches')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'financials')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('update_reason_id')->references('id')->on($this->module_prefix . 'categories')->onUpdate('cascade')->onDelete('set null');
        

        $table->foreign('taxes_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('fees_id')->references('id')->on($this->module_prefix .'fees')->onUpdate('cascade')->onDelete('set null');

        $table->foreign('staff_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('recipient_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        
        $table->foreign('to_account_currency_id')->references('id')->on($this->module_prefix . 'currencies')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_account_currency_id')->references('id')->on($this->module_prefix . 'currencies')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_account_id')->references('id')->on($this->module_prefix . 'accounts')->onDelete('cascade')->onUpdate('cascade');


        $table->foreign('to_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('to_account_id')->references('id')->on($this->module_prefix . 'accounts')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('from_account_cat_id')->references('id')->on($this->module_prefix . 'categories')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('to_account_cat_id')->references('id')->on($this->module_prefix . 'categories')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('main_order_id')->references('id')->on($this->module_prefix . 'orders')->onDelete('cascade')->onUpdate('cascade');
    });
//order_guests

Schema::create($this->module_prefix . 'order_guests', function (Blueprint $table) {

    $table->increments('id');
    $table->text('name')->nullable();
    $table->text('notes')->nullable();
        $table->string('relation_type')->nullable(); //relation with parent user
        $table->string('gender')->nullable();
        $table->text('passport_num')->nullable();
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




    //vouchers

Schema::create($this->module_prefix . 'vouchers', function (Blueprint $table) {

    $table->increments('id');
    $table->text('name');
        $table->string('show_type'); //mobile - web - etc
        $table->string('template_type'); //invoice - Itinerary .. etc
        $table->string('lang_code');
        $table->string('stage'); //suggestion, confirmed
        $table->longText('voucher_note')->nullable();
        $table->boolean('show_logo')->default(1);
        $table->boolean('show_header')->default(1);
        $table->boolean('show_contacts')->default(1);
        $table->boolean('with_tax')->default(0); //1 => taxes included in prices, 0 => taxes not included
        $table->boolean('show_tax')->default(0); //if with taxes included (1)
        $table->boolean('show_tax_method')->default(0); //if with taxes included (1)

        $table->boolean('show_pay_methods_icons')->default(1);
        $table->boolean('show_bank_notes')->default(1);
        $table->boolean('show_bookings_codes')->default(1);
        $table->boolean('total_costs')->default(1);

        $table->boolean('show_hotels')->default(1);
        $table->boolean('show_hotels_prices')->default(1);
        $table->boolean('show_hotels_discounts')->default(1);
        
        $table->boolean('show_flights')->default(1);
        $table->boolean('show_flights_prices')->default(1);
        $table->boolean('show_flights_discounts')->default(1);
        
        $table->boolean('show_pub_transports')->default(1);
        $table->boolean('show_pub_transports_prices')->default(1);
        $table->boolean('show_pub_transports_discounts')->default(1);

        $table->boolean('show_transports')->default(1);
        $table->boolean('show_transports_prices')->default(1);
        $table->boolean('show_transports_discounts')->default(1);

        $table->boolean('show_services')->default(1);
        $table->boolean('show_services_prices')->default(1);
        $table->boolean('show_services_discounts')->default(1);

        $table->boolean('show_activities')->default(1);
        $table->boolean('show_activities_prices')->default(1);
        $table->boolean('show_activities_discounts')->default(1);

        $table->longText('web_html_content')->nullable();
        $table->longText('text_html_content')->nullable();

        $table->text('settings')->nullable();
        $table->longText('notes_contents')->nullable();
        $table->text('notes_options')->nullable();
        $table->text('options')->nullable();

        $table->unsignedInteger('order_id')->nullable();


        $table->unsignedInteger('created_by')->nullable();
        $table->unsignedInteger('updated_by')->nullable();
        $table->timestamps();

        $table->foreign('order_id')->references('id')->on($this->module_prefix . 'orders')->onDelete('cascade')->onUpdate('cascade');
    });

    //Expenses

Schema::create($this->module_prefix .'expenses', function (Blueprint $table) {

    $table->increments('id');
        $table->string('reg_code')->nullable()->unique();
    $table->string('refrence_code')->nullable();
    $table->text('name')->nullable();
    $table->text('description')->nullable();
        $table->string('type')->nullable(); //salary | invoice [Purchases]



    $table->text('notes')->nullable();
    $table->decimal('quantity', 8, 3)->default(1);

            $table->decimal('amount_per_one', 8, 3)->default(0.00); //per one
            $table->decimal('total_amount', 8, 3)->nullable()->default(0.00);

            $table->decimal('fees_percent', 8, 3)->default(0.00);
            $table->decimal('fees_percent_2', 8, 3)->nullable()->default(0.00);
            $table->text('fees_percent_description')->nullable();
            $table->integer('repeated_duration')->nullable();
            $table->string('repeated_unit_durations')->nullable();
        $table->string('repeated_cycles_num')->nullable();

            
            $table->dateTime('paid_at')->nullable();

            $table->boolean('is_billable')->nullable()->default(0);

            $table->tinyInteger('status')->default(0);
                        $table->unsignedInteger('financial_id')->nullable();

            $table->string('value_currency_rate')->nullable();
            $table->string('old_currency_rate')->nullable();
            $table->string('main_currency_rate')->nullable();
            $table->string('modulable_type')->nullable(); //ex. erp_hotel
    $table->unsignedInteger('modulable_id')->nullable(); //ex. id=1
    $table->unsignedInteger('paid_by_id')->nullable();

    $table->unsignedInteger('value_currency_id')->nullable();
    $table->unsignedInteger('main_currency_id')->nullable();
    $table->unsignedInteger('pay_method_id')->nullable(); 


    $table->unsignedInteger('category_id')->nullable(); 

    $table->unsignedInteger('parent_id')->nullable();

    $table->unsignedInteger('branch_id')->nullable();




    $table->unsignedInteger('created_by')->nullable()->index();
    $table->unsignedInteger('updated_by')->nullable()->index();
    $table->timestamps();
    $table->softDeletes();
    $table->foreign('paid_by_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

    $table->foreign('pay_method_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('set null')->onUpdate('cascade');


    $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('set null')->onUpdate('cascade');

    $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'expenses')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('financial_id')->references('id')->on($this->module_prefix . 'financials')->onDelete('cascade')->onUpdate('cascade');


    $table->foreign('branch_id')->references('id')->on($this->module_prefix . 'branches')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('value_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');
    $table->foreign('main_currency_id')->references('id')->on($this->module_prefix.'currencies')->onUpdate('cascade')->onDelete('set null');


});


    //notes


Schema::create($this->module_prefix .'notes', function (Blueprint $table) {

    $table->increments('id');
    $table->text('name')->nullable();
    $table->text('content');
    $table->string('position')->nullable(); //ex. all_hotels_notes
    $table->string('nottable_type')->nullable(); //ex. erp_hotel
    $table->unsignedInteger('nottable_id')->nullable(); //ex. id=1
    $table->tinyInteger('status')->default(0);
    $table->unsignedInteger('category_id')->nullable();

    $table->unsignedInteger('parent_id')->nullable();
    $table->unsignedInteger('country_id')->nullable();
    $table->unsignedInteger('city_id')->nullable();
    $table->unsignedInteger('branch_id')->nullable();
    $table->unsignedInteger('created_by')->nullable()->index();
    $table->unsignedInteger('updated_by')->nullable()->index();
    $table->timestamps();
    $table->softDeletes();
    $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('set null')->onUpdate('cascade');

    $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'notes')->onDelete('cascade')->onUpdate('set null');
    $table->foreign('country_id')->references('id')->on($this->module_prefix . 'countries')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('city_id')->references('id')->on($this->module_prefix . 'cities')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('branch_id')->references('id')->on($this->module_prefix . 'branches')->onDelete('cascade')->onUpdate('cascade');

});

            //notifications


Schema::create($this->module_prefix .'tasks', function (Blueprint $table) {

    $table->increments('id');
    $table->text('title')->nullable();
    $table->text('content')->nullable();
    $table->text('notes')->nullable();

    $table->string('modulable_type')->nullable(); //ex. erp_hotel
    $table->unsignedInteger('modulable_id')->nullable(); //ex. id=1
    $table->tinyInteger('status')->default(0);
    $table->integer('priority_level')->default(0); //0 => law | 1 => medium | 2 => high | 3 => imediatly
    $table->integer('repeated_duration')->nullable();
    $table->string('repeated_unit_durations')->nullable();

    $table->boolean('is_billable')->nullable()->default(0);


    $table->string('user_type')->nullable();
    $table->boolean('send_email')->default(false);
    $table->boolean('send_sms')->default(false);
    $table->dateTime('start_at')->nullable();
    $table->integer('days_num')->nullable();
    $table->dateTime('end_at')->nullable();

    $table->unsignedInteger('task_manager_id')->nullable(); 

    $table->unsignedInteger('category_id')->nullable(); 
    $table->unsignedInteger('parent_id')->nullable();
    $table->unsignedInteger('branch_id')->nullable();
    $table->unsignedInteger('created_by')->nullable()->index();
    $table->unsignedInteger('updated_by')->nullable()->index();
    $table->timestamps();
    $table->softDeletes();
    $table->foreign('task_manager_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

    $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('set null')->onUpdate('cascade');
    $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'tasks')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('branch_id')->references('id')->on($this->module_prefix . 'branches')->onDelete('cascade')->onUpdate('cascade');

});

Schema::create($this->module_prefix .'tasks_users', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedInteger('user_id');
    $table->unsignedInteger('task_id');
    $table->tinyInteger('user_status')->default(0);
    $table->tinyInteger('manager_status')->default(0);

    $table->timestamps();


    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('task_id')->references('id')->on($this->module_prefix .'tasks')->onDelete('cascade')->onUpdate('cascade');


});

    //contact_us


Schema::create($this->module_prefix .'messages', function (Blueprint $table) {

    $table->increments('id');
    $table->text('title')->nullable();
    $table->text('content');
    $table->string('user_type')->default('guest'); //guest || member
    $table->text('user_name')->nullable(); 
    $table->text('user_email')->nullable(); 
    $table->text('user_phone')->nullable(); 
    $table->string('type')->nullable(); //0 => privet || 1 => public

    $table->boolean('seen')->default(false);


    $table->tinyInteger('status')->default(0);
    $table->unsignedInteger('parent_id')->nullable();
    $table->unsignedInteger('main_category_id')->nullable();
    $table->unsignedInteger('sub_category_id')->nullable();
    $table->unsignedInteger('from_user_id')->nullable();
    $table->unsignedInteger('send_to_id')->nullable();


    $table->unsignedInteger('branch_id')->nullable();
    $table->unsignedInteger('created_by')->nullable()->index();
    $table->unsignedInteger('updated_by')->nullable()->index();
    $table->timestamps();
    $table->softDeletes();
    $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'messages')->onDelete('cascade')->onUpdate('set null');
    $table->foreign('main_category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('set null')->onUpdate('cascade');
    $table->foreign('sub_category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('set null')->onUpdate('cascade');
    $table->foreign('branch_id')->references('id')->on($this->module_prefix . 'branches')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('send_to_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

});

        //notifications


Schema::create($this->module_prefix .'notifications', function (Blueprint $table) {

    $table->increments('id');
    $table->text('title')->nullable();
    $table->text('content')->nullable();
    $table->string('modulable_type')->nullable(); //ex. erp_hotel
    $table->unsignedInteger('modulable_id')->nullable(); //ex. id=1
    $table->tinyInteger('status')->default(0);
    $table->integer('priority_level')->default(0); //0 => law | 1 => medium | 2 => high | 3 => imediatly
    $table->tinyInteger('who_notify')->default(0); //for branch => (0 =>all users | 1 => all staff | 2 => all customers | 3 => selected users)
    $table->string('user_type')->nullable();
    $table->boolean('send_email')->default(false);
    $table->boolean('send_sms')->default(false);
    $table->dateTime('start_at')->default(0);
    $table->integer('repeated_duration')->nullable();
    $table->string('repeated_unit_durations')->nullable();

    $table->unsignedInteger('category_id')->nullable(); 
    $table->unsignedInteger('parent_id')->nullable();
    $table->unsignedInteger('branch_id')->nullable();
    $table->unsignedInteger('created_by')->nullable()->index();
    $table->unsignedInteger('updated_by')->nullable()->index();
    $table->timestamps();
    $table->softDeletes();
    $table->foreign('category_id')->references('id')->on($this->module_prefix . 'categories')->onDelete('set null')->onUpdate('cascade');
    $table->foreign('parent_id')->references('id')->on($this->module_prefix . 'notifications')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('branch_id')->references('id')->on($this->module_prefix . 'branches')->onDelete('cascade')->onUpdate('cascade');

});


Schema::create($this->module_prefix .'notifications_users', function (Blueprint $table) {

        $table->increments('id');

    $table->unsignedInteger('user_id');
    $table->unsignedInteger('notification_id');

    $table->timestamps();


    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('notification_id')->references('id')->on($this->module_prefix .'notifications')->onDelete('cascade')->onUpdate('cascade');


});

Schema::create($this->module_prefix .'comments', function (Blueprint $table) {

    $table->increments('id');

    $table->text('title')->nullable();
    $table->text('content')->nullable();


    $table->unsignedInteger('author_id');
    $table->string('commentable_type');
    $table->unsignedInteger('commentable_id');
    $table->unsignedInteger('branch_id')->nullable();
    $table->unsignedInteger('parent_id')->nullable();
    $table->tinyInteger('status')->default(0);



    $table->unsignedInteger('created_by')->nullable()->index();
    $table->unsignedInteger('updated_by')->nullable()->index();
    $table->timestamps();


    $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('parent_id')->references('id')->on($this->module_prefix .'comments')->onDelete('cascade')->onUpdate('cascade');



});




Schema::create($this->module_prefix .'users_views', function (Blueprint $table) {

    $table->increments('id');


    $table->unsignedInteger('user_id');
    $table->string('viewable_type');
    $table->unsignedInteger('viewable_id');
    $table->unsignedInteger('branch_id')->nullable();

    $table->unsignedInteger('created_by')->nullable()->index();
    $table->unsignedInteger('updated_by')->nullable()->index();
    $table->timestamps();


    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');


});

}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists($this->module_prefix.'users_views');

        Schema::dropIfExists($this->module_prefix.'comments');

        Schema::dropIfExists($this->module_prefix.'notifications_users');

        Schema::dropIfExists($this->module_prefix.'notifications');
        Schema::dropIfExists($this->module_prefix.'messages');

        Schema::dropIfExists($this->module_prefix.'tasks_users');

        Schema::dropIfExists($this->module_prefix.'tasks');

        Schema::dropIfExists($this->module_prefix.'notes');

        Schema::dropIfExists($this->module_prefix.'expenses');

        Schema::dropIfExists($this->module_prefix.'vouchers');


        Schema::dropIfExists($this->module_prefix.'vouchers_templates');

        Schema::dropIfExists($this->module_prefix.'order_guests');

        Schema::dropIfExists($this->module_prefix.'financials');
        Schema::dropIfExists($this->module_prefix.'accounts');

        Schema::dropIfExists($this->module_prefix.'services_orders');
        Schema::dropIfExists($this->module_prefix.'activities_orders');


        Schema::dropIfExists($this->module_prefix.'transportations_orders');
        Schema::dropIfExists($this->module_prefix.'buses_orders');
        Schema::dropIfExists($this->module_prefix.'ferries_orders');
        Schema::dropIfExists($this->module_prefix.'flights_orders');
        Schema::dropIfExists($this->module_prefix.'hotel_orders');
        Schema::dropIfExists($this->module_prefix.'orders');
        Schema::dropIfExists($this->module_prefix.'services_prices');
        Schema::dropIfExists($this->module_prefix.'services');
        Schema::dropIfExists($this->module_prefix.'activities_prices');
        Schema::dropIfExists($this->module_prefix.'activities');
        Schema::dropIfExists($this->module_prefix.'buses_prices');
        Schema::dropIfExists($this->module_prefix.'ferries_prices');
        Schema::dropIfExists($this->module_prefix.'flights_prices');
        
        Schema::dropIfExists($this->module_prefix.'airports');
        Schema::dropIfExists($this->module_prefix.'bus_stations');

        Schema::dropIfExists($this->module_prefix.'public_transports');
        Schema::dropIfExists($this->module_prefix.'hotel_prices_dates');
        Schema::dropIfExists($this->module_prefix.'hotel_prices');

        Schema::dropIfExists($this->module_prefix.'seasons');
        Schema::dropIfExists($this->module_prefix.'transport_vehicles_prices');

        Schema::dropIfExists($this->module_prefix.'transport_prices');
        Schema::dropIfExists($this->module_prefix.'vehicles');
        Schema::dropIfExists($this->module_prefix.'drivers_salaries');
        Schema::dropIfExists($this->module_prefix.'journeys');

        Schema::dropIfExists($this->module_prefix.'tours');
        Schema::dropIfExists($this->module_prefix.'rooms');
        Schema::dropIfExists($this->module_prefix.'hotels');

        Schema::dropIfExists($this->module_prefix.'places');

        
        Schema::dropIfExists($this->module_prefix . 'fees_values');
        Schema::dropIfExists($this->module_prefix.'fees');
        

        Schema::dropIfExists($this->module_prefix.'supervisorables');
        Schema::dropIfExists($this->module_prefix.'categoriables');
        Schema::dropIfExists($this->module_prefix.'categories');
        Schema::dropIfExists($this->module_prefix.'branches');
        Schema::dropIfExists($this->module_prefix.'cities');
        Schema::dropIfExists($this->module_prefix.'countries');
        Schema::dropIfExists($this->module_prefix.'currencies_rates');
        Schema::dropIfExists($this->module_prefix.'currencies');
        
    }
}
