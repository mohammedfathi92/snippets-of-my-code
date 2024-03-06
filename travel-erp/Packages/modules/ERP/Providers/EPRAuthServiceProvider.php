<?php

namespace Packages\Modules\ERP\Providers;

use Packages\Modules\ERP\Models\Category;
use Packages\Modules\ERP\Policies\CategoryPolicy;
use Packages\Modules\ERP\Models\Country;
use Packages\Modules\ERP\Policies\CountryPolicy;
use Packages\Modules\ERP\Models\City;
use Packages\Modules\ERP\Policies\CityPolicy;
use Packages\Modules\ERP\Models\Region;
use Packages\Modules\ERP\Policies\RegionPolicy;
use Packages\Modules\ERP\Models\Hotel;
use Packages\Modules\ERP\Policies\HotelPolicy;
use Packages\Modules\ERP\Models\Room;
use Packages\Modules\ERP\Policies\RoomPolicy;
use Packages\Modules\ERP\Models\Place;
use Packages\Modules\ERP\Policies\PlacePolicy;
use Packages\Modules\ERP\Models\Provider;
use Packages\Modules\ERP\Policies\ProviderPolicy;
use Packages\Modules\ERP\Models\Source;
use Packages\Modules\ERP\Policies\SourcePolicy;
use Packages\Modules\ERP\Models\Tour;
use Packages\Modules\ERP\Policies\TourPolicy;
use Packages\Modules\ERP\Models\Vehicle;
use Packages\Modules\ERP\Policies\VehiclePolicy;
use Packages\Modules\ERP\Models\TransportPrice;
use Packages\Modules\ERP\Policies\TransportPricePolicy;
use Packages\Modules\ERP\Models\HotelPrice;
use Packages\Modules\ERP\Policies\HotelPricePolicy;
use Packages\Modules\ERP\Models\FlightPrice;
use Packages\Modules\ERP\Policies\FlightPricePolicy;
use Packages\Modules\ERP\Models\FerryPrice;
use Packages\Modules\ERP\Policies\FerryPricePolicy;
use Packages\Modules\ERP\Models\Airline;
use Packages\Modules\ERP\Policies\AirlinePolicy;
use Packages\Modules\ERP\Models\Airport;
use Packages\Modules\ERP\Policies\AirportPolicy;
use Packages\Modules\ERP\Models\Ferry;
use Packages\Modules\ERP\Policies\FerryPolicy;
use Packages\Modules\ERP\Models\BusStation;
use Packages\Modules\ERP\Policies\BusStationPolicy;
use Packages\Modules\ERP\Models\Account;
use Packages\Modules\ERP\Policies\AccountPolicy;
use Packages\Modules\ERP\Models\Branch;
use Packages\Modules\ERP\Policies\BranchPolicy;
use Packages\Modules\ERP\Models\Year;
use Packages\Modules\ERP\Policies\YearPolicy;
use Packages\Modules\ERP\Models\RoomType;
use Packages\Modules\ERP\Policies\RoomTypePolicy;

use Packages\Modules\ERP\Models\Agent;
use Packages\Modules\ERP\Policies\AgentPolicy;
use Packages\Modules\ERP\Models\Driver;
use Packages\Modules\ERP\Policies\DriverPolicy;
use Packages\Modules\ERP\Models\Order;
use Packages\Modules\ERP\Policies\OrderPolicy;
use Packages\Modules\ERP\Models\Journey;
use Packages\Modules\ERP\Policies\JourneyPolicy;
use Packages\Modules\ERP\Models\UserErp;
use Packages\Modules\ERP\Policies\CustomerPolicy;
use Packages\Modules\ERP\Models\VehicleDetial;
use Packages\Modules\ERP\Policies\VehicleDetialPolicy;
use Packages\Modules\ERP\Policies\FinancialPolicy;
use Packages\Modules\ERP\Models\Financial;
use Packages\Modules\ERP\Models\ServicePrice;
use Packages\Modules\ERP\Models\ActivityPrice;
use Packages\Modules\ERP\Models\Service;
use Packages\Modules\ERP\Models\Activity;
use Packages\Modules\ERP\Policies\ServicePricePolicy;
use Packages\Modules\ERP\Policies\ActivityPricePolicy;
use Packages\Modules\ERP\Policies\ServicePolicy;
use Packages\Modules\ERP\Policies\ActivityPolicy;

use Packages\Modules\ERP\Models\BusPrice;
use Packages\Modules\ERP\Models\Bus;
use Packages\Modules\ERP\Policies\BusPricePolicy;
use Packages\Modules\ERP\Policies\BusPolicy;





use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ERPAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Region::class => RegionPolicy::class,
        Country::class => CountryPolicy::class,
        City::class => CityPolicy::class,
        Hotel::class =>  HotelPolicy::class,
        Room::class =>  RoomPolicy::class,
        Place::class => PlacePolicy::class,
        Provider::class => ProviderPolicy::class,
        Vehicle::class => VehiclePolicy::class,
        TransportPrice::class => TransportPricePolicy::class,
        HotelPrice::class => HotelPricePolicy::class,
        FlightPrice::class => FlightPricePolicy::class,
        FerryPrice::class => FerryPricePolicy::class,
        Source::class => SourcePolicy::class,
        Tour::class => TourPolicy::class,
        Airline::class => AirlinePolicy::class,
        Airport::class => AirportPolicy::class,
        Ferry::class => FerryPolicy::class,
        BusStation::class => BusStationPolicy::class,
        Account::class => AccountPolicy::class,
        Branch::class => BranchPolicy::class,
        Year::class => YearPolicy::class,
        RoomType::class => RoomTypePolicy::class,
        Agent::class => AgentPolicy::class,
        Driver::class => DriverPolicy::class,
        Order::class => OrderPolicy::class,
        Journey::class => JourneyPolicy::class,
        UserErp::class => CustomerPolicy::class,
        VehicleDetail::class => VehicleDetailPolicy::class,
        Financial::class => FinancialPolicy::class,
        
        Service::class => ServicePolicy::class,
        ServicePrice::class => ServicePricePolicy::class,
        Activity::class => ActivityPolicy::class,
        ActivityPrice::class => ActivityPricePolicy::class,
        Bus::class => BusPolicy::class,
        BusPrice::class => BusPricePolicy::class,




    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}