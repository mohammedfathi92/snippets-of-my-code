<?php

namespace Packages\Modules\ERP\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AltarUsersTable extends Migration
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
    Schema::table('users', function($table) {
        $table->text('nick_name')->nullable();
        $table->text('nick_name_en')->nullable();
        $table->string('user_gender')->default('male')->nullable();
        $table->text('name_en')->nullable();
        $table->text('translated_name')->nullable();
        $table->text('translated_nick_name')->nullable();
        
        $table->text('user_notes')->nullable();
        $table->text('about_user')->nullable();
        $table->text('contact_person')->nullable(); //name of contact person if agent or providers
        $table->date('birth_date')->nullable();
        $table->string('age_type')->nullable(); //mature, child ..etch
        $table->integer('age')->nullable();
        $table->text('passport_number')->nullable();
        $table->text('primary_phone')->nullable();
        $table->text('phone_one')->nullable();
        $table->text('phone_two')->nullable();
        $table->text('phone_three')->nullable();
        $table->text('fax_number')->nullable();
        $table->text('main_address')->nullable();
        $table->string('user_code')->unique()->nullable();
        
        $table->string('account_type')->nullable(); //person or company
        $table->string('agent_hp')->nullable();
        $table->string('commission_room')->nullable();
        $table->string('commission_tour')->nullable();
        $table->string('commission_ticket')->nullable();
        $table->string('commission_package')->nullable();
        
        $table->decimal('tax_value', 8, 2)->nullable();
        $table->text('website_link')->nullable();
        $table->text('options')->nullable();
        
        
        $table->boolean('status')->default(1)->nullable();

         $table->unsignedInteger('nationality_id')->nullable()->index();

        $table->unsignedInteger('country_id')->nullable()->index();
        $table->unsignedInteger('city_id')->nullable()->index();
        $table->unsignedInteger('parent_id')->nullable()->index();
        $table->unsignedInteger('currency_id')->nullable();
        $table->unsignedInteger('provider_id')->nullable();
        $table->unsignedInteger('agent_id')->nullable();
        $table->unsignedInteger('branch_id')->nullable();
        $table->unsignedInteger('category_id')->nullable();

        $table->foreign('nationality_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('category_id')->references('id')->on($this->module_prefix .'categories')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('country_id')->references('id')->on($this->module_prefix .'countries')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('city_id')->references('id')->on($this->module_prefix .'cities')->onDelete('cascade')->onUpdate('cascade'); 

        $table->foreign('provider_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null'); 
        $table->foreign('agent_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null'); 
        $table->foreign('branch_id')->references('id')->on($this->module_prefix .'branches')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('currency_id')->references('id')->on($this->module_prefix .'currencies')->onDelete('cascade')->onUpdate('cascade');

        $table->foreign('parent_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');   

    });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    Schema::table('users', function($table) {
        $table->dropColumn('name_en');
        $table->dropColumn('nick_name');
        $table->dropColumn('nick_name_en');
        $table->dropColumn('user_gender');
        $table->dropColumn('translated_name');
        $table->dropColumn('translated_nick_name');
        $table->dropColumn('user_notes');
        $table->dropColumn('about_user');
        $table->dropColumn('contact_person'); //name of contact person if agent or providers
        $table->dropColumn('primary_phone');
        $table->dropColumn('phone_one');
        $table->dropColumn('phone_two');
        $table->dropColumn('phone_three');
        $table->dropColumn('fax_number');
        
        $table->dropColumn('main_address');
        $table->dropColumn('user_code');
        $table->dropColumn('account_type');
        $table->dropColumn('agent_hp');
        $table->dropColumn('commission_room');
        $table->dropColumn('commission_tour');
        $table->dropColumn('commission_ticket');
        $table->dropColumn('commission_package');
        $table->dropColumn('passport_number');
        $table->dropForeign(['nationality']);
        $table->dropForeign(['country_id']);
        $table->dropForeign(['city_id']);
        $table->dropForeign(['parent_id']);
        $table->dropForeign(['currency_id']);
        $table->dropForeign(['provider_id']);
        $table->dropForeign(['agent_id']);
        $table->dropForeign(['branch_id']);
        $table->dropColumn('nationality');
        $table->dropColumn('country_id');
        $table->dropColumn('city_id');
        $table->dropColumn('parent_id');
        $table->dropColumn('currency_id');
        $table->dropColumn('provider_id');
        $table->dropColumn('agent_id');
        $table->dropColumn('branch_id');

    });

    }
}


// currencies
// currencies_rates
// countries
// cities
// categories
// categoriables
// fees
// fees_values
// places
// hotels
// rooms
// travels
// drivers
// vehicles
// transport_prices
// transport_prices_vehicles
// years
// hotel_prices
// days
// hotel_prices_days
// hotel_prices_dates
// public_transports
// public_transports_prices
// bus_stations
// airports
// branches
// journey
// orders
// hotel_orders
// public_transports_orders
// transportations_orders
// services
// services_prices
// services_orders
// accounts
// financials
// user_companions
