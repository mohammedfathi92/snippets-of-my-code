<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("currencies", function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('code', 3)->unique();
            $table->string('symbol_left', 20)->nullable();
            $table->string('symbol_right', 20)->nullable();
            $table->char('decimal_place', 1)->default("4");
            $table->float('value', 15, 8)->nullable()->default("1.00000000");
            $table->boolean('status')->default(true);
            $table->timestamps();

        });

        \Illuminate\Support\Facades\DB::table("currencies")->insert([[
            'name'         => 'US Dollar',
            'code'         => 'USD',
            'symbol_right' => '',
            'symbol_left'  => '$',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ], [
            'name'         => 'Euro',
            'code'         => 'EUR',
            'symbol_right' => '€',
            'symbol_left'  => '',
            'created_at'   => \Carbon\Carbon::now(),
            'updated_at'   => \Carbon\Carbon::now(),
        ],[
            'name'         => 'Saudi Riyal',
            'code'         => 'SAR',
            'symbol_right' => 'sar',
            'symbol_left'  => '',
            'created_at'   => \Carbon\Carbon::now(),
            'updated_at'   => \Carbon\Carbon::now(),
        ],[
            'name'         => 'Swedish Krona',
            'code'         => 'SEK',
            'symbol_right' => 'kr',
            'symbol_left'  => '',
            'created_at'   => \Carbon\Carbon::now(),
            'updated_at'   => \Carbon\Carbon::now(),
        ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("currencies_info");
    }
}
