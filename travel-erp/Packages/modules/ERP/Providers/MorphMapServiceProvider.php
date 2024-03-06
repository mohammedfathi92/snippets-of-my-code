<?php

namespace Packages\Modules\ERP\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class MorphMapServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {

        Relation::morphMap([
            'erp_hotel'   => 'Packages\Modules\ERP\Models\Hotel',
            'erp_airport'   => 'Packages\Modules\ERP\Models\Airport',
            'erp_bus_station'   => 'Packages\Modules\ERP\Models\BusStation',
            'erp_ferry'   => 'Packages\Modules\ERP\Models\Ferry',
            'erp_tour'   => 'Packages\Modules\ERP\Models\Tour',
            'erp_journey'   => 'Packages\Modules\ERP\Models\Journey',
            'erp_service'   => 'Packages\Modules\ERP\Models\Service',
            'erp_activity'   => 'Packages\Modules\ERP\Models\Activity',
            'erp_bus_station'   => 'Packages\Modules\ERP\Models\BusStation',
            'erp_place'   => 'Packages\Modules\ERP\Models\Place',
            
            'erp_main_order'   => 'Packages\Modules\ERP\Models\Order',
            'erp_hotel_order'   => 'Packages\Modules\ERP\Models\HotelOrder',
            'erp_ferry_order'   => 'Packages\Modules\ERP\Models\FerryOrder',
            'erp_flight_order'   => 'Packages\Modules\ERP\Models\FlightOrder',
            'erp_bus_order'   => 'Packages\Modules\ERP\Models\BusOrder',
            'erp_transport_order'   => 'Packages\Modules\ERP\Models\TransportOrder',
            'erp_service_order'   => 'Packages\Modules\ERP\Models\ServiceOrder',
            'erp_activity_order'   => 'Packages\Modules\ERP\Models\ActivityOrder',
            'erp_expense'   => 'Packages\Modules\ERP\Models\Expense',

           ]);
    }

}
