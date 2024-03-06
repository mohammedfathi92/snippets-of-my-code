<?php

namespace Packages\Modules\ERP\database\seeds;

use Illuminate\Database\Seeder;

class ERPMenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //categories
        $categories_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'erp_categories',
            'url' => null,
            'active_menu_url' => 'categories*',
            'name' => 'Categories',
            'description' => 'categories Menu Item',
            'icon' => 'fa fa-globe',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);

        // {"en":"Home","ar":"home"}

        // categories children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $categories_menu_id,
                    'key' => null,
                    'url' => 'erp/categories/create',
                    'active_menu_url' =>'categories/create',
                    'name' => 'New Category',
                    'description' => 'Categories List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $categories_menu_id,
                    'key' => null,
                    'url' => config('erp.models.category.resource_url'),
                    'active_menu_url' => 'categories*',
                    'name' => 'Categories',
                    'description' => 'Categories List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]
        );




          //countries
        $countries_menu_id = \DB::table('menus')->insert([
            'parent_id' => 1,// admin
            'key' => 'erp_countries',
            'url' => config('erp.models.country.resource_url'),
            'active_menu_url' => 'countries*',
            'name' => 'Countries',
            'description' => 'countries Menu Item',
            'icon' => 'fa fa-globe',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);



        //customers
        $customers_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'erp_customers',
            'url' => null,
            'active_menu_url' => 'customers*',
            'name' => 'Customers',
            'description' => 'Customers Menu Item',
            'icon' => 'fa fa-user',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);

        // Customers children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $customers_menu_id,
                    'key' => null,
                    'url' => 'erp/customers/create' ,
                    'active_menu_url' =>'customers/create' ,
                    'name' => 'New Customer',
                    'description' => 'Customers List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $customers_menu_id,
                    'key' => null,
                    'url' => config('erp.models.customer.resource_url'),
                    'active_menu_url' => config('erp.models.customer.resource_url'),
                    'name' => 'Customers List',
                    'description' => 'Customers List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);



          //orders
        $orders_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'erp_orders',
            'url' => null,
            'active_menu_url' => 'orders*',
            'name' => 'Orders',
            'description' => 'Orders Menu Item',
            'icon' => 'fa fa-credit-card',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);

        // Orders children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $orders_menu_id,
                    'key' => null,
                    'url' => 'erp/orders/create' ,
                    'active_menu_url' =>'orders/create' ,
                    'name' => 'New Order',
                    'description' => 'Orders List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $orders_menu_id,
                    'key' => null,
                    'url' => config('erp.models.order.resource_url'),
                    'active_menu_url' => config('erp.models.order.resource_url'),
                    'name' => 'Orders List',
                    'description' => 'Orders List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],

                 [
                    'parent_id' => $orders_menu_id,
                    'key' => null,
                    'url' => config('erp.models.hotel_order.resource_url'),
                    'active_menu_url' => config('erp.models.hotel_order.resource_url'),
                    'name' => 'Hotels Orders List',
                    'description' => 'Hotels Orders List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],

                 [
                    'parent_id' => $orders_menu_id,
                    'key' => null,
                    'url' => config('erp.models.flight_order.resource_url'),
                    'active_menu_url' => config('erp.models.flight_order.resource_url'),
                    'name' => 'Flights Orders List',
                    'description' => 'Flights Orders List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],

                 [
                    'parent_id' => $orders_menu_id,
                    'key' => null,
                    'url' => config('erp.models.transport_order.resource_url'),
                    'active_menu_url' => config('erp.models.transport_order.resource_url'),
                    'name' => 'Transports Orders List',
                    'description' => 'Transports Orders List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],

                 [
                    'parent_id' => $orders_menu_id,
                    'key' => null,
                    'url' => config('erp.models.manual_hotel_order.resource_url'),
                    'active_menu_url' => config('erp.models.manual_hotel_order.resource_url'),
                    'name' => 'Manual Hotels Orders List',
                    'description' => 'Manual Hotels Orders List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],


                [
                    'parent_id' => $orders_menu_id,
                    'key' => null,
                    'url' => config('erp.models.current_customer.resource_url'),
                    'active_menu_url' => config('erp.models.current_customer.resource_url'),
                    'name' => 'Current Customers List',
                    'description' => 'Current Customers List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],

            ]);



          //packages
        $packages_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'erp_packages',
            'url' => null,
            'active_menu_url' => 'packages*',
            'name' => 'Packages',
            'description' => 'Packages Menu Item',
            'icon' => 'fa fa-gift',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);

        // Packages children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $packages_menu_id,
                    'key' => null,
                    'url' => 'erp/packages/create' ,
                    'active_menu_url' =>'packages/create' ,
                    'name' => 'New Order',
                    'description' => 'Packages List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $packages_menu_id,
                    'key' => null,
                    'url' => config('erp.models.package.resource_url'),
                    'active_menu_url' => config('erp.models.package.resource_url'),
                    'name' => 'Packages List',
                    'description' => 'Packages List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],

                 [
                    'parent_id' => $packages_menu_id,
                    'key' => null,
                    'url' => config('erp.models.hotel_package.resource_url'),
                    'active_menu_url' => config('erp.models.hotel_package.resource_url'),
                    'name' => 'Hotels Packages List',
                    'description' => 'Hotels Packages List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],

                 [
                    'parent_id' => $packages_menu_id,
                    'key' => null,
                    'url' => config('erp.models.flight_package.resource_url'),
                    'active_menu_url' => config('erp.models.flight_package.resource_url'),
                    'name' => 'Flights Packages List',
                    'description' => 'Flights Packages List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],

                 [
                    'parent_id' => $packages_menu_id,
                    'key' => null,
                    'url' => config('erp.models.transport_package.resource_url'),
                    'active_menu_url' => config('erp.models.transport_package.resource_url'),
                    'name' => 'Transports Packages List',
                    'description' => 'Transports Packages List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],

          

            ]);





        //Hotels setting

        $hotels_setting_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'erp_hotels_setting',
            'url' => null,
            'active_menu_url' => null,
            'name' => 'Hotels Setting',
            'description' => 'Hotels Setting Menu Item',
            'icon' => 'fa fa-building',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);


      //Hotels
        $hotels_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => $hotels_setting_menu_id,
            'key' => 'erp_hotels',
            'url' => null,
            'active_menu_url' => 'hotels*',
            'name' => 'Hotels',
            'description' => 'Hotels Menu Item',
            'icon' => 'fa fa-building-o',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);

       

        // Hotels children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $hotels_menu_id,
                    'key' => null,
                    'url' =>'erp/hotels/create', 
                    'active_menu_url' =>'hotels/create*',
                    'name' => 'New Hotel',
                    'description' => 'Hotels List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $hotels_menu_id,
                    'key' => null,
                    'url' => config('erp.models.hotel.resource_url'),
                    'active_menu_url' => config('erp.models.hotel.resource_url'),
                    'name' => 'Hotels List',
                    'description' => 'Hotels List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);



      //Rooms
        $rooms_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => $hotels_setting_menu_id,
            'key' => 'erp_rooms',
            'url' => null,
            'active_menu_url' => 'rooms*',
            'name' => 'Rooms',
            'description' => 'Rooms Menu Item',
            'icon' => 'fa fa-bed',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);

       

        // Rooms children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $rooms_menu_id,
                    'key' => null,
                    'url' =>'erp/rooms/create', 
                    'active_menu_url' =>'rooms/create*',
                    'name' => 'New Room',
                    'description' => 'Rooms List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $rooms_menu_id,
                    'key' => null,
                    'url' => config('erp.models.menuroom.resource_url'),
                    'active_menu_url' => config('erp.models.menuroom.resource_url'),
                    'name' => 'Rooms List',
                    'description' => 'Rooms List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);

        //Rooms Types
        $roomtypes_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => $hotels_setting_menu_id,
            'key' => 'erp_roomtypes',
            'url' => null,
            'active_menu_url' => 'roomtypes*',
            'name' => 'Rooms Types',
            'description' => 'Rooms Types Menu Item',
            'icon' => 'fa fa-bed',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);

       

        // Rooms Types children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $roomtypes_menu_id,
                    'key' => null,
                    'url' =>'erp/roomtypes/create', 
                    'active_menu_url' =>'roomtypes/create*',
                    'name' => 'New Room Type',
                    'description' => 'Rooms Types List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $roomtypes_menu_id,
                    'key' => null,
                    'url' => config('erp.models.roomtype.resource_url'),
                    'active_menu_url' => config('erp.models.roomtype.resource_url'),
                    'name' => 'Rooms Types List',
                    'description' => 'Rooms Types List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);







         //Prices Rate

        $prices_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'erp_prices',
            'url' => null,
            'active_menu_url' => 'prices*',
            'name' => 'Prices Rate',
            'description' => 'prices Menu Item',
            'icon' => 'fa fa-area-chart',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);


        // prices children menu
        $transport_price_menu_id= \DB::table('menus')->insertGetId(
                [
                    'parent_id' => $prices_menu_id,
                    'key' => 'erp_transport_prices',
                    'url' => null,
                    'active_menu_url' => 'prices/transports*',
                    'name' => 'Transports',
                    'description' => 'Transports Menu Item',
                    'icon' => 'fa fa-bus',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);
          \DB::table('menus')->insert([
                [
                    'parent_id' => $transport_price_menu_id,
                    'key' => null,
                    'url' =>'erp/prices/transports/create' ,
                    'active_menu_url' => 'transports/create*',
                    'name' => 'New Transport',
                    'description' => 'Transports List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $transport_price_menu_id,
                    'key' => null,
                    'url' => config('erp.models.transportprice.resource_url'),
                    'active_menu_url' => config('erp.models.transportprice.resource_url'),
                    'name' => 'Transports List',
                    'description' => 'Transports List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);

        $hotel_price_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $prices_menu_id,
                    'key' => 'erp_hotel_prices',
                    'url' => null,
                    'active_menu_url' => 'prices/hotels*',
                    'name' => 'Hotels',
                    'description' => 'Hotels Menu Item',
                    'icon' => 'fa fa-bed',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $hotel_price_menu_id,
                    'key' => null,
                    'url' =>'erp/prices/hotels/create',
                    'active_menu_url' => 'prices/hotels/create',
                    'name' => 'New Hotel',
                    'description' => 'Hotels List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $hotel_price_menu_id,
                    'key' => null,
                    'url' => config('erp.models.hotelprice.resource_url'),
                    'active_menu_url' => config('erp.models.hotelprice.resource_url'),
                    'name' => 'Hotels List',
                    'description' => 'Hotels List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);

        $ferry_price_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $prices_menu_id,
                    'key' => 'erp_ferry_prices',
                    'url' => null,
                    'active_menu_url' => 'prices/ferries*',
                    'name' => 'Ferries',
                    'description' => 'Ferries Menu Item',
                    'icon' => 'fa fa-ship',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

          \DB::table('menus')->insert([
                [
                    'parent_id' => $ferry_price_menu_id,
                    'key' => null,
                    'url' => 'erp/prices/ferry/create' ,
                    'active_menu_url' => 'prices/ferry/create' ,
                    'name' => 'New Ferry',
                    'description' => 'Ferries List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $ferry_price_menu_id,
                    'key' => null,
                    'url' => config('erp.models.ferryprice.resource_url'),
                    'active_menu_url' => config('erp.models.ferryprice.resource_url'),
                    'name' => 'Ferries List',
                    'description' => 'Ferries List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);


        $flight_price_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $prices_menu_id,
                    'key' => 'erp_flight_prices',
                    'url' => null,
                    'active_menu_url' => 'prices/flights*',
                    'name' => 'Flights',
                    'description' => 'Flights Menu Item',
                    'icon' => 'fa fa-plane',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);
         \DB::table('menus')->insert([
                [
                    'parent_id' => $flight_price_menu_id,
                    'key' => null,
                    'url' => 'erp/prices/flight/create',
                    'active_menu_url' => 'prices/flight/create',
                    'name' => 'New Flight',
                    'description' => 'Flights List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $flight_price_menu_id,
                    'key' => null,
                    'url' => config('erp.models.flightprice.resource_url'),
                    'active_menu_url' => config('erp.models.flightprice.resource_url'),
                    'name' => 'Flights List',
                    'description' => 'Flights List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);



        //transports setting

        $transports_setting_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'erp_transports_setting',
            'url' => null,
            'active_menu_url' => null,
            'name' => 'Transports Setting',
            'description' => 'Transports Setting Menu Item',
            'icon' => 'fa fa-taxi',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);


        $airline_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $transports_setting_menu_id,
                    'key' => 'erp_airlines',
                    'url' => null,
                    'active_menu_url' => 'airlines*',
                    'name' => 'Airlines',
                    'description' => 'Airlines Menu Item',
                    'icon' => 'fa fa-plane',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

          \DB::table('menus')->insert([
                [
                    'parent_id' => $airline_menu_id,
                    'key' => null,
                    'url' => 'erp/airlines/create' ,
                    'active_menu_url' => 'airlines/create' ,
                    'name' => 'New Airline',
                    'description' => 'Airlines List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $airline_menu_id,
                    'key' => null,
                    'url' => config('erp.models.airline.resource_url'),
                    'active_menu_url' => config('erp.models.airline.resource_url'),
                    'name' => 'Airlines List',
                    'description' => 'Airlines List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);

        $airport_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $transports_setting_menu_id,
                    'key' => 'erp_airports',
                    'url' => null,
                    'active_menu_url' => 'airports*',
                    'name' => 'Airports',
                    'description' => 'Airports Menu Item',
                    'icon' => 'fa fa-plane',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);


          \DB::table('menus')->insert([
                [
                    'parent_id' => $airport_menu_id,
                    'key' => null,
                    'url' => 'erp/airports/create' ,
                    'active_menu_url' => 'airports/create' ,
                    'name' => 'New Airport',
                    'description' => 'Airports List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $airport_menu_id,
                    'key' => null,
                    'url' => config('erp.models.airport.resource_url'),
                    'active_menu_url' => config('erp.models.airport.resource_url'),
                    'name' => 'Airports List',
                    'description' => 'Airports List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);

        $bus_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $transports_setting_menu_id,
                    'key' => 'erp_busstations',
                    'url' => null,
                    'active_menu_url' => 'busstations*',
                    'name' => 'Bus Stations',
                    'description' => 'Bus Stations Menu Item',
                    'icon' => 'fa fa-bus',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

         \DB::table('menus')->insert([
                [
                    'parent_id' => $bus_menu_id,
                    'key' => null,
                    'url' => 'erp/busstations/create',
                    'active_menu_url' => 'busstations/create',
                    'name' => 'New Bus Station',
                    'description' => 'Bus Stations List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $bus_menu_id,
                    'key' => null,
                    'url' => config('erp.models.busstation.resource_url'),
                    'active_menu_url' => config('erp.models.busstation.resource_url'),
                    'name' => 'Bus Stations List',
                    'description' => 'Bus Stations List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);

         $ferry_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $transports_setting_menu_id,
                    'key' => 'erp_ferries',
                    'url' => null,
                    'active_menu_url' => 'ferries*',
                    'name' => 'Ferries',
                    'description' => 'Ferries Menu Item',
                    'icon' => 'fa fa-ship',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $ferry_menu_id,
                    'key' => null,
                    'url' => 'erp/ferries/create',
                    'active_menu_url' => 'ferries/create' ,
                    'name' => 'New Ferry',
                    'description' => 'Ferries List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $ferry_menu_id,
                    'key' => null,
                    'url' => config('erp.models.ferry.resource_url'),
                    'active_menu_url' => config('erp.models.ferry.resource_url'),
                    'name' => 'Ferries List',
                    'description' => 'Ferries List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);


         $veihcle_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $transports_setting_menu_id,
                    'key' => 'erp_vehicles',
                    'url' => null,
                    'active_menu_url' => 'vehicles*',
                    'name' => 'Vehicles',
                    'description' => 'Vehicles Menu Item',
                    'icon' => 'fa fa-car',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $veihcle_menu_id,
                    'key' => null,
                    'url' => 'erp/vehicles/create',
                    'active_menu_url' => 'vehicles/create' ,
                    'name' => 'New Vehicle',
                    'description' => 'Vehicles List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $veihcle_menu_id,
                    'key' => null,
                    'url' => config('erp.models.vehicle.resource_url'),
                    'active_menu_url' => config('erp.models.vehicle.resource_url'),
                    'name' => 'Vehicles List',
                    'description' => 'Vehicles List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);

        //vehicle details
        $vehicle_detail_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $transports_setting_menu_id,
                    'key' => 'erp_vehicle_details',
                    'url' => null,
                    'active_menu_url' => 'vehicle_details*',
                    'name' => 'Vehicles Details',
                    'description' => 'Vehicles Details Menu Item',
                    'icon' => 'fa fa-car',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $vehicle_detail_menu_id,
                    'key' => null,
                    'url' => 'erp/vehicle_details/create',
                    'active_menu_url' => 'vehicle_details/create' ,
                    'name' => 'New Vehicle Detail',
                    'description' => 'Vehicles Details List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $vehicle_detail_menu_id,
                    'key' => null,
                    'url' => config('erp.models.vehicle_detail.resource_url'),
                    'active_menu_url' => config('erp.models.vehicle_detail.resource_url'),
                    'name' => 'Vehicles Details List',
                    'description' => 'Vehicles Details List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);



        //Our Partners

        $partners_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'erp_our_partners',
            'url' => null,
            'active_menu_url' => null,
            'name' => 'Our Partners',
            'description' => 'Partners Menu Item',
            'icon' => 'fa fa-handshake-o',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);

          // Agents 
        $agent_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $partners_menu_id,
                    'key' => 'erp_agents',
                    'url' => null,
                    'active_menu_url' => 'agents*',
                    'name' => 'Agents',
                    'description' => 'Agents Menu Item',
                    'icon' => 'fa fa-user',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $agent_menu_id,
                    'key' => null,
                    'url' => 'erp/agents/create',
                    'active_menu_url' => 'agents/create',
                    'name' => 'New Agent',
                    'description' => 'Agents List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $agent_menu_id,
                    'key' => null,
                    'url' => config('erp.models.agent.resource_url'),
                    'active_menu_url' => config('erp.models.agent.resource_url'),
                    'name' => 'Agents List',
                    'description' => 'Agents List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);


        //Branch
        $branch_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $partners_menu_id,
                    'key' => 'erp_banches',
                    'url' => null,
                    'active_menu_url' => 'banches*',
                    'name' => 'Branches',
                    'description' => 'Branches Menu Item',
                    'icon' => 'fa fa-university',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $branch_menu_id,
                    'key' => null,
                    'url' => 'erp/branches/create',
                    'active_menu_url' =>'branches/create',
                    'name' => 'New Branch',
                    'description' => 'Branches List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $branch_menu_id,
                    'key' => null,
                    'url' => config('erp.models.branch.resource_url'),
                    'active_menu_url' => config('erp.models.branch.resource_url'),
                    'name' => 'Branches List',
                    'description' => 'Branches List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);


        //provider
        $provider_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $partners_menu_id,
                    'key' => 'erp_providers',
                    'url' => null,
                    'active_menu_url' => 'providers*',
                    'name' => 'Providers',
                    'description' => 'Providers Menu Item',
                    'icon' => 'fa fa-globe',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $provider_menu_id,
                    'key' => null,
                    'url' => 'erp/providers/create',
                    'active_menu_url' => 'providers/create',
                    'name' => 'New Provider',
                    'description' => 'Providers List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $provider_menu_id,
                    'key' => null,
                    'url' => config('erp.models.provider.resource_url'),
                    'active_menu_url' => config('erp.models.provider.resource_url'),
                    'name' => 'Providers List',
                    'description' => 'Providers List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);

        // Drivers 
        $driver_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $partners_menu_id,
                    'key' => 'erp_drivers',
                    'url' => null,
                    'active_menu_url' => 'drivers*',
                    'name' => 'Drivers',
                    'description' => 'Drivers Menu Item',
                    'icon' => 'fa fa-id-card-o ',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $driver_menu_id,
                    'key' => null,
                    'url' => 'erp/drivers/create',
                    'active_menu_url' => 'drivers/create',
                    'name' => 'New Driver',
                    'description' => 'Drivers List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $driver_menu_id,
                    'key' => null,
                    'url' => config('erp.models.driver.resource_url'),
                    'active_menu_url' => config('erp.models.driver.resource_url'),
                    'name' => 'Drivers List',
                    'description' => 'Drivers List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);

            //financials
        $financials_menu_id = \DB::table('menus')->insert([
            'parent_id' => 1,// admin
            'key' => 'erp_financials',
            'url' => '/erp/financials',
            'active_menu_url' => 'financials*',
            'name' => 'Financials',
            'description' => 'Financials Menu Item',
            'icon' => 'fa fa-money',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);



          //accounts
        $accounts_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'erp_accounts',
            'url' => null,
            'active_menu_url' => 'accounts*',
            'name' => 'Accounts',
            'description' => 'Accounts Menu Item',
            'icon' => 'fa fa-credit-card',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);

        // Accounts children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $accounts_menu_id,
                    'key' => null,
                    'url' => 'erp/accounts/create' ,
                    'active_menu_url' =>'accounts/create' ,
                    'name' => 'New Account',
                    'description' => 'Accounts List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $accounts_menu_id,
                    'key' => null,
                    'url' => config('erp.models.account.resource_url'),
                    'active_menu_url' => config('erp.models.account.resource_url'),
                    'name' => 'Accounts List',
                    'description' => 'Accounts List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);





    




        //Public Setting

        $public_setting_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'erp_public_setting',
            'url' => null,
            'active_menu_url' => null,
            'name' => 'Public Setting',
            'description' => 'Public Setting Menu Item',
            'icon' => 'fa fa-cog',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);              

        //travel 
        $travel_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $public_setting_menu_id,
                    'key' => 'erp_travels',
                    'url' => null,
                    'active_menu_url' => 'travels*',
                    'name' => 'Travels',
                    'description' => 'Travels Menu Item',
                    'icon' => 'fa fa-plane',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $travel_menu_id,
                    'key' => null,
                    'url' => 'erp/travels/create',
                    'active_menu_url' => 'travels/create' ,
                    'name' => 'New Travel',
                    'description' => 'Travels List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $travel_menu_id,
                    'key' => null,
                    'url' => config('erp.models.travel.resource_url'),
                    'active_menu_url' => config('erp.models.travel.resource_url'),
                    'name' => 'Travels List',
                    'description' => 'Travels List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);


         //Places
        $places_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => $public_setting_menu_id,// admin
            'key' => 'erp_places',
            'url' => null,
            'active_menu_url' => 'places*',
            'name' => 'Places',
            'description' => 'Places Menu Item',
            'icon' => 'fa fa-street-view',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);


        // Places children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $places_menu_id,
                    'key' => null,
                    'url' =>'erp/places/create',
                    'active_menu_url' =>'places/create' ,
                    'name' => 'New Place',
                    'description' => 'Places List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $places_menu_id,
                    'key' => null,
                    'url' => config('erp.models.place.resource_url'),
                    'active_menu_url' => config('erp.models.place.resource_url'),
                    'name' => 'Places List',
                    'description' => 'Places List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);

        //order types 
        $ordertype_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $public_setting_menu_id,
                    'key' => 'erp_ordertypes',
                    'url' => null,
                    'active_menu_url' => 'ordertypes*',
                    'name' => 'Order Types',
                    'description' => 'Order Types Menu Item',
                    'icon' => 'fa fa-phone-square',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $ordertype_menu_id,
                    'key' => null,
                    'url' => 'erp/ordertypes/create',
                    'active_menu_url' => 'ordertypes/create' ,
                    'name' => 'New Order Type',
                    'description' => 'Order Types List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $ordertype_menu_id,
                    'key' => null,
                    'url' => config('erp.models.ordertype.resource_url'),
                    'active_menu_url' => config('erp.models.ordertype.resource_url'),
                    'name' => 'Order Types List',
                    'description' => 'Order Types List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);

        //journey 
        $journey_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $public_setting_menu_id,
                    'key' => 'erp_journeys',
                    'url' => null,
                    'active_menu_url' => 'journeys*',
                    'name' => 'Journeys',
                    'description' => 'Journeys Menu Item',
                    'icon' => 'fa fa-street-view',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $journey_menu_id,
                    'key' => null,
                    'url' => 'erp/journeys/create',
                    'active_menu_url' => 'journeys/create' ,
                    'name' => 'New Journey',
                    'description' => 'Journeys List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $journey_menu_id,
                    'key' => null,
                    'url' => config('erp.models.journey.resource_url'),
                    'active_menu_url' => config('erp.models.journey.resource_url'),
                    'name' => 'Journeys List',
                    'description' => 'Journeys List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);
        //Years 
        $year_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $public_setting_menu_id,
                    'key' => 'erp_years',
                    'url' => null,
                    'active_menu_url' => 'years*',
                    'name' => 'Years',
                    'description' => 'Years Menu Item',
                    'icon' => 'fa fa-calendar ',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $year_menu_id,
                    'key' => null,
                    'url' => 'erp/years/create',
                    'active_menu_url' => 'years/create' ,
                    'name' => 'New Year',
                    'description' => 'Years List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $year_menu_id,
                    'key' => null,
                    'url' => config('erp.models.year.resource_url'),
                    'active_menu_url' => config('erp.models.year.resource_url'),
                    'name' => 'Years List',
                    'description' => 'Years List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);

            //Pre-pay Percents 
        $year_menu_id= \DB::table('menus')->insertGetId([
                    'parent_id' => $public_setting_menu_id,
                    'key' => 'erp_prepay_percents',
                    'url' => null,
                    'active_menu_url' => 'pre_percents*',
                    'name' => 'Pre-pay Percents',
                    'description' => 'Pre-pay Percents Menu Item',
                    'icon' => 'fa fa-money ',
                    'target' => null, 'roles' => '["1","2"]',
                    'order' => 0
        ]);

        \DB::table('menus')->insert([
                [
                    'parent_id' => $year_menu_id,
                    'key' => null,
                    'url' => 'erp/pre_percents/create',
                    'active_menu_url' => 'pre_percents/create' ,
                    'name' => 'New Pre-pay Percent',
                    'description' => 'Pre-pay Percents List Menu Item',
                    'icon' => 'fa fa-plus-square',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
                 [
                    'parent_id' => $year_menu_id,
                    'key' => null,
                    'url' => config('erp.models.pre_percent.resource_url'),
                    'active_menu_url' => config('erp.models.pre_percent.resource_url'),
                    'name' => 'Pre-pay Percents List',
                    'description' => 'Pre-pay Percents List Menu Item',
                    'icon' => 'fa fa-list',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]);






        
       
    }
}
