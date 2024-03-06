<?php

namespace Packages\Modules\ERP\Providers;

use Packages\Modules\ERP\Models\Category;
use Packages\Modules\ERP\Models\Region;
use Packages\Modules\ERP\Models\Country;
use Packages\Modules\ERP\Models\City;
use Packages\Modules\ERP\Models\Hotel;
use Packages\Modules\ERP\Models\Room;
use Packages\Modules\ERP\Models\Place;
use Packages\Modules\ERP\Models\Provider;
use Packages\Modules\ERP\Models\Vehicle;
use Packages\Modules\ERP\Models\TransportPrice;
use Packages\Modules\ERP\Models\HotelPrice;
use Packages\Modules\ERP\Models\FlightPrice;
use Packages\Modules\ERP\Models\FerryPrice;
use Packages\Modules\ERP\Models\Airline;
use Packages\Modules\ERP\Models\Airport;
use Packages\Modules\ERP\Models\Ferry;
use Packages\Modules\ERP\Models\BusStation;
use Packages\Modules\ERP\Models\Account;
use Packages\Modules\ERP\Models\Branch;
use Packages\Modules\ERP\Models\ServicePrice;
use Packages\Modules\ERP\Models\ActivityPrice;
use Packages\Modules\ERP\Models\Service;
use Packages\Modules\ERP\Models\Activity;

use Packages\Modules\ERP\Observers\CategoryObserver;
use Packages\Modules\ERP\Observers\RegionObserver;
use Packages\Modules\ERP\Observers\CountryObserver;
use Packages\Modules\ERP\Observers\CityObserver;
use Packages\Modules\ERP\Observers\HotelObserver;
use Packages\Modules\ERP\Observers\RoomObserver;
use Packages\Modules\ERP\Observers\PlaceObserver;
use Packages\Modules\ERP\Observers\ProviderObserver;
use Packages\Modules\ERP\Observers\VehicleObserver;
use Packages\Modules\ERP\Observers\TransportPriceObserver;
use Packages\Modules\ERP\Observers\HotelPriceObserver;
use Packages\Modules\ERP\Observers\FlightlPriceObserver;
use Packages\Modules\ERP\Observers\FerryPriceObserver;
use Packages\Modules\ERP\Observers\AirlineObserver;
use Packages\Modules\ERP\Observers\AirportObserver;
use Packages\Modules\ERP\Observers\FerryObserver;
use Packages\Modules\ERP\Observers\BusStationObserver;
use Packages\Modules\ERP\Observers\AccountObserver;
use Packages\Modules\ERP\Observers\BranchObserver;

use Packages\Modules\ERP\Models\Year;
use Packages\Modules\ERP\Observers\YearObserver;
use Packages\Modules\ERP\Models\RoomType;
use Packages\Modules\ERP\Observers\RoomTypeObserver;

use Packages\Modules\ERP\Models\Agent;
use Packages\Modules\ERP\Observers\AgentObserver;
use Packages\Modules\ERP\Models\Driver;
use Packages\Modules\ERP\Observers\DriverObserver;
use Packages\Modules\ERP\Models\Order;
use Packages\Modules\ERP\Observers\OrderObserver;
use Packages\Modules\ERP\Models\Journey;
use Packages\Modules\ERP\Observers\JourneyObserver;
use Packages\Modules\ERP\Models\UserErp;
use Packages\Modules\ERP\Observers\CustomerObserver;
use Packages\Modules\ERP\Observers\ServicePriceObserver;
use Packages\Modules\ERP\Observers\ActivityPriceObserver;
use Packages\Modules\ERP\Observers\ServiceObserver;
use Packages\Modules\ERP\Observers\ActivityObserver;



use Packages\Modules\ERP\Observers\FinancialObserver;
use Packages\Modules\ERP\Models\Financial;

use Packages\Modules\ERP\Observers\TourObserver;
use Packages\Modules\ERP\Models\Tour;

use Packages\Modules\ERP\Observers\BusObserver;
use Packages\Modules\ERP\Models\Bus;
use Packages\Modules\ERP\Observers\BusPriceObserver;
use Packages\Modules\ERP\Models\BusPrice;

use Packages\Modules\ERP\Observers\ExpenseObserver;
use Packages\Modules\ERP\Models\Expense;


use Illuminate\Support\ServiceProvider;

class ERPObserverServiceProvider extends ServiceProvider
{
    /**
     * Register Observers
     */
    public function boot()
    {

        Category::observe(CategoryObserver::class);
        Region::observe(RegionObserver::class);
        Country::observe(CountryObserver::class);
        City::observe(CityObserver::class);
        Hotel::observe(HotelObserver::class);
        Room::observe(RoomObserver::class);
        Place::observe(PlaceObserver::class);
        Provider::observe(ProviderObserver::class);
        Vehicle::observe(VehicleObserver::class);
        TransportPrice::observe(TransportPriceObserver::class);
        HotelPrice::observe(HotelPriceObserver::class);
        FlightPrice::observe(FlightPriceObserver::class);
        FerryPrice::observe(FerryPriceObserver::class);
        Airline::observe(AirlineObserver::class);
        Airport::observe(AirportObserver::class);
        Ferry::observe(FerryObserver::class);
        BusStation::observe(BusStationObserver::class);
        Account::observe(AccountObserver::class);
        Branch::observe(BranchObserver::class);
        Year::observe(YearObserver::class);
        RoomType::observe(RoomTypeObserver::class);
        Agent::observe(AgentObserver::class);
        Driver::observe(DriverObserver::class);
        Order::observe(OrderObserver::class);
        UserErp::observe(CustomerObserver::class);
        Financial::observe(FinancialObserver::class);

        Service::observe(ServiceObserver::class);
        ServicePrice::observe(ServicePriceObserver::class);
        Activity::observe(ActivityObserver::class);
        ActivityPrice::observe(ActivityPriceObserver::class);
        Tour::observe(TourObserver::class);
                Expense::observe(ExpenseObserver::class);



    }
}