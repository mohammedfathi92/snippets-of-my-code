<?php

return [
    'models' => [
       'category' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\CategoryPresenter::class,
            'resource_url' => 'erp/categories',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
         'region' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\RegionPresenter::class,
            'resource_url' => 'erp/regions',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
       'country' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\CountryPresenter::class,
            'resource_url' => 'erp/countries',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
       'city' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\CityPresenter::class,
            'resource_route' => 'erp.countries.cities.index',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
        'hotel' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\HotelPresenter::class,
            'resource_url' => 'erp/hotels',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
        'room' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\RoomPresenter::class,
            'resource_route' => 'erp.hotels.rooms.index',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
        'menuroom' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\HotelPresenter::class,
            'resource_url' => 'erp/rooms',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
        'place' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\PlacePresenter::class,
            'resource_url' => 'erp/places',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'provider' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\ProviderPresenter::class,
            'resource_url' => 'erp/providers',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'tour' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\TourPresenter::class,
            'resource_url' => 'erp/tours',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'source' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\SourcePresenter::class,
            'resource_url' => 'erp/sources',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'vehicle' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\VehiclePresenter::class,
            'resource_url' => 'erp/vehicles',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'transportprice' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\TransportPricePresenter::class,
            'resource_url' => 'erp/prices/transports',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'hotelprice' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\HotelPricePresenter::class,
            'resource_url' => 'erp/prices/hotels',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
        'currency' => [
           'presenter' => \Packages\Modules\ERP\Transformers\CurrencyPresenter::class,
           'resource_url' => 'erp/currencies',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'flightprice' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\FlightPricePresenter::class,
            'resource_url' => 'erp/prices/flights',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'ferryprice' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\FerryPricePresenter::class,
            'resource_url' => 'erp/prices/ferries',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
        'busprice' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\BusPricePresenter::class,
            'resource_url' => 'erp/prices/buses',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
        'bus' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\BusPresenter::class,
            'resource_url' => 'erp/buses',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
        'busstation' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\BusStationPresenter::class,
            'resource_url' => 'erp/busstations',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
        'airline' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\AirlinePresenter::class,
            'resource_url' => 'erp/airlines',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'airport' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\AirportPresenter::class,
            'resource_url' => 'erp/airports',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'ferry' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\FerryPresenter::class,
            'resource_url' => 'erp/ferries',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'branch' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\BranchPresenter::class,
            'resource_url' => 'erp/branches',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'account' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\AccountPresenter::class,
            'resource_url' => 'erp/accounts',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'year' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\YearPresenter::class,
            'resource_url' => 'erp/years',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'roomtype' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\RoomTypePresenter::class,
            'resource_url' => 'erp/roomtypes',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'ordertype' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\OrderTypePresenter::class,
            'resource_url' => 'erp/ordertypes',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'agent' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\AgentPresenter::class,
            'resource_url' => 'erp/agents',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'driver' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\DriverPresenter::class,
            'resource_url' => 'erp/drivers',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'order' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\OrderPresenter::class,
            'resource_url' => 'erp/orders',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
        'journey' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\JourneyPresenter::class,
            'resource_url' => 'erp/journeys',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
        'hotel_order' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\HotelOrderPresenter::class,
            'resource_url' => 'erp/orders/lists/hotels',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'manual_hotel_order' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\ManualHotelOrderPresenter::class,
            'resource_url' => 'erp/orders/lists/manual-hotels',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'flight_order' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\FlightOrderPresenter::class,
            'resource_url' => 'erp/orders/lists/flights',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],
        'transport_order' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\TransportOrderPresenter::class,
            'resource_url' => 'erp/orders/lists/transports',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'current_customer' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\CurrentCustomerPresenter::class,
            'resource_url' => 'erp/orders/lists/current-customers',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'customer' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\CustomerPresenter::class,
            'resource_url' => 'erp/customers',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'customer_order' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\CustomerOrderPresenter::class,
            'resource_url' => 'erp/orders/lists/customer_orders',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],



         'package' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\PackagePresenter::class,
            'resource_url' => 'erp/packages',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'hotel_package' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\HotelPackagePresenter::class,
            'resource_url' => 'erp/packages/lists/hotels',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'flight_package' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\FlightPackagePresenter::class,
            'resource_url' => 'erp/packages/lists/flights',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'transport_package' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\TransportPackagePresenter::class,
            'resource_url' => 'erp/packages/lists/transports',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'financial' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\FinancialPresenter::class,
            'resource_url' => 'erp/financials',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'service' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\ServicePresenter::class,
            'resource_url' => 'erp/services',
            'default_image' => 'assets/packages/images/default_product_image.png',
            ],

        'activity' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\ActivityPresenter::class,
            'resource_url' => 'erp/activities',
            'default_image' => 'assets/packages/images/default_product_image.png',    
        ],

        'serviceprice' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\ServicePricePresenter::class,
            'resource_url' => 'erp/prices/services',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        'activityprice' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\ActivityPricePresenter::class,
            'resource_url' => 'erp/prices/activities',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],

        

            'expense' => [
            'presenter'    => \Packages\Modules\ERP\Transformers\ExpensePresenter::class,
            'resource_url' => 'erp/expenses',
            'default_image' => 'assets/packages/images/default_product_image.png',
        ],


    ]
];