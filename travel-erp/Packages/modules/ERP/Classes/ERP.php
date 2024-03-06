<?php

namespace Packages\Modules\ERP\Classes;

use Packages\Modules\ERP\Models\Category;
use Packages\Modules\ERP\Models\Region;
use Packages\Modules\ERP\Models\UserErp;
use Packages\Modules\ERP\Models\Country;
use Packages\Modules\ERP\Models\City;
use Packages\Modules\ERP\Models\Place;
use Packages\Modules\ERP\Models\Provider;
use Packages\Modules\ERP\Models\Vehicle;
use Packages\Modules\ERP\Models\Currency;
use Packages\Modules\ERP\Models\Source;
use Packages\Modules\ERP\Models\Branch;
use Packages\Modules\ERP\Models\Year;
use Packages\Modules\ERP\Models\Account;
use Packages\Modules\ERP\Models\RoomType;
use Packages\Modules\ERP\Models\Agent;
use Packages\Modules\ERP\Models\Airline;
use Packages\Modules\ERP\Models\Ferry;
use Packages\Modules\ERP\Models\Bus;
use Packages\Modules\ERP\Models\Driver;
use Packages\Modules\ERP\Models\Hotel;
use Packages\Modules\ERP\Models\Room;
use Packages\Modules\ERP\Models\Tour;
use Packages\Modules\ERP\Models\BusStation;
use Packages\Modules\ERP\Models\Airport;
use Packages\Modules\ERP\Models\Journey;
use Packages\Modules\ERP\Models\Customer;
use Packages\Modules\ERP\Models\Activity;
use Packages\Modules\ERP\Models\Service;
use Packages\Modules\ERP\Models\Order;

use Packages\User\Models\User;

class ERP
{
     /**
     * ERP constructor.
     */
    function __construct()
    {
    }

    



    public function getUserData($user_id = null){

        $user = User::find($user_id);

         return $user;

     }

    public function randUniqCode($pref = null, $authId = null){

        if($number < 7){
            $number = 7;
        }

         $code = substr(str_shuffle(str_repeat(hexdec(uniqid()), 100)), 0, $number);

         return $code;

       }


      public function codeGenerator($string = null, $type = null, $number = 14){

        $string = uniqid().hashids_encode(1234567890).'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'.$string.uniqid();

        if($number < 7){
            $number = 7;
        }

         $code = substr(str_shuffle(str_repeat(uniqid().$string, 100)), 0, $number);

         return $code;

     }



     public function getCategoriesTypes()
    {
        $types = [

         'general' => __('ERP::attributes.categories.types.general'),
          'orders_purposes' => __('ERP::attributes.categories.types.orders_purposes'),
         // 'orders' => __('ERP::attributes.categories.types.orders'),
          'places' => __('ERP::attributes.categories.types.places'),
          'hotels' => __('ERP::attributes.categories.types.hotels'),
          'rooms' => __('ERP::attributes.categories.types.rooms'),
          'services' => __('ERP::attributes.categories.types.services'),
          // 'tour_places' => __('ERP::attributes.categories.types.tour_places'),
          'transports' => __('ERP::attributes.categories.types.transports'),
          // 'pub_transports' => __('ERP::attributes.categories.types.pub_transports'),
          'airlines' => __('ERP::attributes.categories.types.airlines'),
          'ferries' => __('ERP::attributes.categories.types.ferries'),
          'vehicles' => __('ERP::attributes.categories.types.vehicles'),
          'financial_accounts' => __('ERP::attributes.categories.types.accounts'),
          'payment_methods' => __('ERP::attributes.categories.types.payment_methods'),
          'users' => __('ERP::attributes.categories.types.users'),
          'providers' => __('ERP::attributes.categories.types.providers'),
          'agents' => __('ERP::attributes.categories.types.agents'),
          'customers' => __('ERP::attributes.categories.types.customers'),
          'drivers' => __('ERP::attributes.categories.types.drivers'),
          'fees' => __('ERP::attributes.categories.types.fees'),
          'update_financial_reasons' => __('ERP::attributes.categories.types.update_financial_reasons'),
          'expenses' => __('ERP::attributes.categories.types.expenses'),
          // 'promoters' => __('ERP::attributes.categories.types.promoters'),

        ];
        return $types;
    }

  public function generateRegCode($attribute = [], $type = null)
    {
        $code = null;
        
        return  $code;
    }

public function getUsersListByType($type, $status = 1)
    {
       $users = UserErp::where('status', $status)->where('user_type', $type)->pluck('name', 'id')->toArray();
        return  $users;
    }

    public function getUsersList($status = 1)
    {
        $users = UserErp::where('status', $status)->pluck('name', 'id')->toArray();
        return  $users;
    }

            public function getStaffList($status=1){

        $users = UserErp::where('status', $status)->pluck('name', 'id')->toArray();
        return  $users;

     }

        public function getServicesList($city_id= null, $status = 1)
    {
      $services = [];
      if($city_id){
        $services = Service::where('status', $status)->pluck('name', 'id')->toArray();

      }else{
        $services = Service::where('status', $status)->where('city_id', $city_id)->pluck('name', 'id')->toArray();
      }

        return  $services;
    }

            public function getCurrentInProgressOrders($cat_id= null)
    {

        $orders = Order::where('status', '>', 1)->where('status', '<', 5)->pluck('reg_code', 'id')->toArray();


        return  $orders;
    }



        public function getActivitiesList($city_id = null, $status = 1)
    {
      if($city_id){
        $activities = Activity::where('status', $status)->pluck('name', 'id')->toArray();

      }else{

      $activities = Activity::where('status', $status)->where('city_id', $city_id)->pluck('name', 'id')->toArray();

      }

        return  $activities;
    }



    public function storeUser($request, $type = null, $exceptions = [])
    {

        $request->merge(['name' => $request->input('translated_name.ar'), 'name_en' => $request->input('translated_name.en'), 'nick_name' => $request->input('translated_nick_name.ar'), 'nick_name_en' => $request->input('translated_nick_name.en'), 'user_type' => $type]);

    if(is_null($request->get('user_password'))){
        $request->merge(['password' => encrypt(uniqid())]);  
        }else{

        $request->merge(['password' => encrypt($request->get('user_password'))]);    

        }



     $data = $request->except(array_merge(['picture_thumb', 'passport_image', 'user_password'], $exceptions));

     if($type == 'agent'){
      $user = Agent::create($data);
     }elseif ($type == 'provider') {
       $user = Provider::create($data);
     }elseif ($type == 'driver') {
       $user = Driver::create($data);
     }else{
      $user = UserErp::create($data);
     }

    if ($request->hasFile('picture_thumb')) {
        $file = $request->file('picture_thumb');
        $collection = 'user-picture';
        $this->addUserMedia($user, $file, $collection);
    }

      if ($request->hasFile('passport_image')) {
    $user->addMedia($request->file('passport_image'))
        ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
        ->toMediaCollection('passport-image');
       }


        return $user;
    }



    public function updateUser($request, $user, $type = null, $exceptions = [])
    {

    $request->merge(['name' => $request->input('translated_name.ar'), 'name_en' => $request->input('translated_name.en'), 'nick_name' => $request->input('translated_nick_name.ar'), 'nick_name_en' => $request->input('translated_nick_name.en'), 'user_type' => $type]);
    
    if(!is_null($request->get('user_password'))){
         $request->merge(['password' => encrypt($request->get('user_password'))]);  
        }

     $data = $request->except(array_merge(['picture_thumb', 'passport_image', 'user_password','clear_picture','clear_passport'], $exceptions));   
   

     $user->update($data);

            if ($request->has('clear_picture') || $request->hasFile('picture_thumb')) {
                $user->clearMediaCollection('user-picture');
            }

    if ($request->hasFile('picture_thumb') && !$request->has('clear_picture')) {
         $file = $request->file('picture_thumb');
         $collection = 'user-picture';
         $this->addUserMedia($user, $file, $collection);
            }


        if ($request->has('clear_passport') || $request->hasFile('passport_image')) {
                $user->clearMediaCollection('passport-image');
            }
           if ($request->hasFile('passport_image')) {
                $user->addMedia($request->file('passport_image'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection('passport-image');
                   }


        return $user;
    }

    /**
     * @param Request $request
     * @param User $user
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
     */
    protected function addUserMedia(UserErp $user, $file, $collection)
    {
        $user->addMedia($file)
            ->withCustomProperties(['root' => 'user_' . $user->hashed_id])
            ->toMediaCollection('user-picture');
    }




  public function getAirlinesList($status = 1)
    {
        $airlines = Airline::where('status', $status)->where('transport_type','airline')->pluck('name', 'id');


        return $airlines;
    }

public function getPlacesByType($category, $city_id = null, $status = 1)
    {
        switch ($category) {
          case 'erp_hotel':
            $options = Hotel::where('city_id', $city_id)->where('status', 1)->pluck('name', 'id')->toArray();
            break;

          case 'erp_airport':
            $options = Airport::where('city_id', $city_id)->where('status', 1)->pluck('name', 'id')->toArray();
            break;

          case 'erp_bus_station':
            $options = BusStation::where('city_id', $city_id)->where('status', 1)->pluck('name', 'id')->toArray();
            break; 
            
          case 'erp_ferry':
            $options = Ferry::where('city_id', $city_id)->where('status', 1)->pluck('name', 'id')->toArray();
            break; 

          case 'erp_tour':
            $options = Tour::where('city_id', $city_id)->where('status', 1)->pluck('name', 'id')->toArray();
            break;

          case 'erp_journey':
            $options = Journey::where('city_id', $city_id)->where('status', 1)->pluck('name', 'id')->toArray();
            break;

          case 'erp_service':
            $options = Service::where('city_id', $city_id)->where('status', 1)->pluck('name', 'id')->toArray();
            break;

          case 'erp_activity':
            $options = Activity::where('city_id', $city_id)->where('status', 1)->pluck('name', 'id')->toArray();
            break;
          case 'erp_place':
            $options = Place::where('city_id', $city_id)->where('status', 1)->pluck('name', 'id')->toArray();
            break;  
          
          default:
            $options = [];
            break;
        }


        return $options;
    }    

public function getCategoriesByType($type, $status = 1)
    {
        $categories = Category::where('type', $type)->where('status', $status)->pluck('name', 'id');


        return $categories;
    }

      public function getCategoriesParents($current_cat, $status = 1)
    {
        $categories = Category::where('id', '!=', $current_cat)->where('status', $status)->pluck('name', 'id');


        return $categories;
    }

          public function getCategoriesList($status = 1)
    {
        $categories = Category::where('status', $status)->pluck('name', 'id');


        return $categories;
    }


        //   public function getCategoriesList($objects = false, $status = null)
    // {
    //     $categories = Category::whereNotNull('id');

    //     $not_available_categories = $this->getNotAvailableCategories();
    //     if ($not_available_categories) {
    //         $categories->whereNotIn('id', $not_available_categories);
    //     }
    //     if ($status) {
    //         $categories = $categories->where('status', $status);
    //     }
    //     if ($objects) {
    //         $categories = $categories->get();
    //     } else {
    //         $categories = $categories->pluck('name', 'id');
    //     }
    //     return $categories;
    // }

    public function getParentCategoriesList($skip = 0, $objects = false, $status = null)
    {
        $categories = Category::whereNotNull('id')->where('id','!=', $skip);

        $not_available_categories = $this->getNotAvailableCategories();
        if ($not_available_categories) {
            $categories->whereNotIn('id', $not_available_categories);
        }
        if ($status) {
            $categories = $categories->where('status', $status);
        }
        if ($objects) {
            $categories = $categories->get();
        } else {
            $categories = $categories->pluck('name', 'id');
        }
        return $categories;
    }

    public function getNotAvailableCategories()
    {
        if (isSuperUser()) {
            return [];
        }
        $not_available_categories = [];
        if (\Modules::isModuleActive('developnet-subscriptions')) {

            $categories = Category::all();
            $not_available_categories = [];
            foreach ($categories as $category) {
                $subscription_plans = $category->subscribable_plans;
                if ($subscription_plans) {
                    foreach ($subscription_plans as $subscription_plan) {
                        if (!user() || !user()->subscriptions->contains($subscription_plan->id)) {
                            $not_available_categories [] = $category->id;

                        }
                    }
                }
            }
        }
        return $not_available_categories;
    }

      public function accountsCategories($objects = false, $status = null){
        $accounts = Category::where('type','accounts');
         $accounts = $accounts->pluck('name', 'id');


        return $accounts;
    }

    public function getFinancialsAccountsList($objects = false, $status = 1){
        $accounts = Account::where('status',$status)->pluck('name', 'id');


        return $accounts;
    }


        public function getFinancialsAccountsByCategory($category_id,$objects = false, $status = 1){
        $accounts = Account::where('status',$status)->where('category_id', $category_id)->pluck('name', 'id');


        return $accounts;
    }




     public function getRegionsList($objects = false, $status = null){
        $regions = Region::whereNotNull('id');
         $regions = $regions->pluck('name', 'id');


        return $regions;
    }
    public function getCountriesList($status = 1){
        $countries = Country::where('status', $status)->pluck('name', 'id');

        return $countries;
    }
    

    public function getCitiesList($country_id = null, $status = null){
      if($country_id){
          $cities = City::where('country_id', $country_id)->where('status', 1)->pluck('name', 'id');
      }else{
         $cities = City::where('status', 1)->pluck('name', 'id');

      }

        return $cities;
    }

    public function getDriversListByCountry($country_id = null){
          $drivers = [];
      if($country_id){
          $drivers = Driver::where('country_id', $country_id)->where('status', 1)->pluck('name', 'id');
      }

      return $drivers;
    }

    public function getCitiesListByCountry($country_id = null){
          $cities = [];
      if($country_id){
          $cities = City::where('country_id', $country_id)->where('status', 1)->pluck('name', 'id');
      }

      return $cities;
    }


     public function getHotelsList($city_id = null, $status = null){

          $hotels = [];
      if($city_id){
          $hotels = Hotel::where('city_id', $city_id)->where('status', 1)->pluck('name', 'id');
      }

      return $hotels;
    }

    public function getRoomsList($hotel_id = null, $status = null){

      $rooms = [];

      if($hotel_id){
          $rooms = Room::where('hotel_id', $hotel_id)->where('status', 1)->pluck('name', 'id');
      }

      return $rooms;
    }
   

    public function getPlacesList($objects = false, $status = null){
        $places = Place::whereNotNull('id');
         $places = $places->pluck('name', 'id');


        return $places;
    }

     public function getProvidersList($objects = false, $status = null){
        $providers = Provider::whereNotNull('id');
         $providers = $providers->pluck('name', 'id');


        return $providers;
    }

    public function getProvidersDataList($objects = false, $status = null){
        $providers = Provider::whereNotNull('id');
         $providers = $providers->select('translated_name', 'id', 'user_code')->get();


        return $providers;
    }

    public function getVehicleList($objects = false, $status = null){
        $vehicles = Vehicle::whereNotNull('id');
         $vehicles = $vehicles->pluck('name', 'id');


        return $vehicles;
    }
 public function getCurrenciesList($objects = false, $status = null){
        $currencies = Currency::whereNotNull('id');
         $currencies = $currencies->pluck('name', 'id');


        return $currencies;
    }

     public function defaultCurrencyName(){
      $name = null;
        $currency = Currency::where('code', config('default.currency'))->first();
        if($currency){
          $currency->name;
        }
        return $name;
    }

 public function getBranchesList($objects = false, $status = null){
        $Branches = Branch::whereNotNull('id');
         $Branches = $Branches->pluck('name', 'id');

        return $Branches;
    }

     public function getMainAccountsList($objects = false, $status = null){
        $main = Account::where('type' , 'main');
         $main = $main->pluck('name', 'id');

        return $main;
    }


     public function getYearsList($objects = false, $status = null){
        $years = Year::whereNotNull('id');
         $years = $years->pluck('year', 'id');

        return $years;
    }
     public function getRoomTypesList($objects = false, $status = null){
        $types = RoomType::whereNotNull('id');
         $types = $types->pluck('name', 'id');

        return $types;
    }

    

    public function getEmployeesList($objects = false, $status = null){
        $employees = UserErp::whereNotNull('id');
         $employees = $employees->pluck('name', 'id');

        return $employees;
    }


     public function getAgentsList($objects = false, $status = null){
        $agents = Agent::whereNotNull('id');
         $agents = $agents->pluck('name', 'id');

        return $agents;
    }


       public function getFerriesList($objects = false, $status = null){
        $ferries = Ferry::whereNotNull('id');
         $ferries = $ferries->where('transport_type','ferry')->pluck('name', 'id');

        return $ferries;
    }

    public function getBusesList($objects = false, $status = null){
        $buses = Bus::whereNotNull('id');
         $buses = $buses->where('transport_type', 'bus')->pluck('name', 'id');

        return $buses;
    }


     public function getDriversList($objects = false, $status = null){
        $drivers = Driver::whereNotNull('id');
         $drivers = $drivers->pluck('name', 'id');

        return $drivers;
    }

    public function getCustomersList($withCode = true, $status = null){
        $customers = UserErp::whereNotNull('id');
         $customers = $customers->pluck('name', 'id');

        return $customers;
    }


    public function getCountriesData($status = null){
        $countries = Country::whereNotNull('id')->where('status', 1)->select('id', 'name', 'currency_id')->get();

        return  $countries;
    }

    public function getCurrenciesData($status = null){
        $currencies = Currency::whereNotNull('id')->select('id', 'name', 'exchange_rate')->get();

        return  $currencies;
    }



    



}