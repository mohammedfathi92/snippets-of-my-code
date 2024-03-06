<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\Classes\ERP;
use Packages\Modules\ERP\DataTables\CitiesDataTable;
use Packages\Modules\ERP\Http\Requests\CityRequest;
use Packages\Modules\ERP\Models\City;
use Packages\Modules\ERP\Models\Place;
use Packages\Modules\ERP\Models\Hotel;
use Packages\Modules\ERP\Models\Room;
use Packages\Modules\ERP\Models\Tour;
use Packages\Modules\ERP\Models\Country;
use Packages\Modules\ERP\Models\Account;
use Packages\Modules\ERP\Models\Driver;
use Packages\Modules\ERP\Models\UserErp;
use Packages\Modules\ERP\Models\Airport;
use Packages\Modules\ERP\Models\BusStation;
use Packages\Modules\ERP\Models\Ferry;
use Packages\Modules\ERP\Models\Journey;
use Packages\Modules\ERP\Models\Service;
use Packages\Modules\ERP\Models\Activity;
use Packages\Modules\ERP\Models\HotelPrice;
use Packages\Modules\ERP\Models\FlightPrice;
use Packages\Modules\ERP\Models\FerryPrice;
use Packages\Modules\ERP\Models\TransportPrice;

use Illuminate\Http\Request;
use Validator;


class AjaxController extends BaseController
{


     public function getUserAccounts(Request $request, $user_id){

        if(!$request->ajax()){
          return abort(404);
        }

       $accounts = Account::where('status', 1)->where('user_id', $user_id)->pluck('name', 'id')->toArray();

       return response()->json(['success' => true, 'message' => 'get users', 'list'=> $accounts]);                                                            
    }
    

        public function getAccountBalance(Request $request){

        if(!$request->ajax()){
          return abort(404);
        }

        

        if($account_id = $request->get('account_id')){
          $account = Account::find($account_id);
          if(!$account){
            $balance = 0.0;
          }else{
            $balance = $account->balance?:0.0;
          }

        return response()->json(['success' => true, 'message' => 'get account balance', 'balance'=>$balance]);


        }

        $balance = 0.0;

           return response()->json(['success' => true, 'message' => 'get account balance', 'balance'=>$balance]);

                                     
    }

    public function getCategoryAccounts(Request $request){

        if(!$request->ajax()){
          return abort(404);
        }

        $accounts = Account::where('status', 1);

        if($request->get('cat_id') || $request->get('user_id')){

        if($request->get('cat_id')){
          $accounts->where('category_id', $request->get('cat_id'));
        }

         if($request->get('user_id')){
          $accounts->where('user_id', $request->get('user_id'));
         }

        }else{

           return response()->json(['success' => true, 'message' => 'get accounts', 'list'=>[]]);

        }



         $account_arr = $accounts->pluck('name', 'id')->toArray();

       return response()->json(['success' => true, 'message' => 'get accounts', 'list'=>$account_arr]);                                                            
    }

   
  public function getAutoPrices(Request $request, $type){
     $is_classfy = false;
     $dataArray = [];

          switch ($type) {
            case 'flight':

            $is_classfy = true;

       if(!$request->item || !$request->startDate || !$request->fromCity || !$request->toCity){

         return  response()->json(['success' => false, 'is_empty' => false, 'data'=> null, 'message' => __('ERP::messages.orders.required_flight_auto_prices')]);

        }

        $item = FlightPrice::where('from_city_id', $request->fromCity)->where('to_city_id', $request->toCity)->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->whereDate('start_date', '<', $request->startDate)->first();

                if(!$item){
          return  response()->json(['success' => false, 'is_empty' => true, 'data'=> null, 'message' => __('ERP::messages.orders.not_found_prices')]);
        }

              break;

            case 'ferry':


              
            $is_classfy = true;

       if(!$request->item || !$request->startDate || !$request->fromCity || !$request->toCity){

         return  response()->json(['success' => false, 'is_empty' => false, 'data'=> null, 'message' => __('ERP::messages.orders.required_ferry_auto_prices')]);

        }

        $item = FerryPrice::where('from_city_id', $request->fromCity)->where('to_city_id', $request->toCity)->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->whereDate('start_date', '<', $request->startDate)->first();

                if(!$item){
          return  response()->json(['success' => false, 'is_empty' => true, 'data'=> null, 'message' => __('ERP::messages.orders.not_found_prices')]);
        }


              break;
            case 'transport':


            $is_classfy = false;

       if(!$request->item || !$request->startDate || !$request->source || !$request->target){

         return  response()->json(['success' => false, 'is_empty' => false, 'data'=> null, 'message' => __('ERP::messages.orders.required_transport_auto_prices')]);

        }

        $item = TransportPrice::where('from_city_id', $request->fromCity)->where('to_city_id', $request->toCity)->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->whereDate('start_date', '<', $request->startDate)->whereHas('vehicles_prices', function($q) use ($request){
            $q->where('category_id', $request->item);
        })->with('vehicles_prices')->first();


       if(!$item){


        return  response()->json(['success' => false, 'is_empty' => false, 'data'=> null, 'message' => __('ERP::messages.orders.not_found_prices')]);

       }

       $vehicle = $item->vehicles_prices()->where('category_id', $request->item)->first();

       if(!$vehicle){


        return  response()->json(['success' => false, 'is_empty' => false, 'data'=> null, 'message' => __('ERP::messages.orders.not_found_prices')]);

       }


        $dataArray = (object) [
          'price_id' => $item->id,
          'price' => $vehicle->price,
          'cost' => $vehicle->cost,
          'currency_id' => $vehicle->currency_id, 

        ];

              break;
            case 'service':
            $is_classfy = false;
            if(!$request->item || !$request->startDate || !$request->fromCity || !$request->toCity){

         return  response()->json(['success' => false, 'is_empty' => false, 'data'=> null, 'message' => __('ERP::messages.orders.required_service_auto_prices')]);

        }

        $item = ServicePrice::where('city_id', $request->city)->where('service_id', $request->item)->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->whereDate('start_date', '<', $request->startDate)->first();

                if(!$item){
          return  response()->json(['success' => false, 'is_empty' => true, 'data'=> null, 'message' => __('ERP::messages.orders.not_found_prices')]);
        }

        $dataArray = (object) [
          'price_id' => $item->id,
          'price' => $item->price,
          'cost' => $item->cost,
           'currency_id' => $item->currency_id, 

        ];
              break;

             


            case 'activity':

             $is_classfy = true;

         if(!$request->item || !$request->startDate || !$request->city){

         return  response()->json(['success' => false, 'is_empty' => false, 'data'=> null, 'message' => __('ERP::messages.orders.required_activity_auto_prices')]);

        }

        $item = ActivityPrice::where('city_id', $request->city)->where('activity_id', $request->item)->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->whereDate('start_date', '<', $request->startDate)->first();
                if(!$item){
          return  response()->json(['success' => false, 'is_empty' => true, 'data'=> null, 'message' => __('ERP::messages.orders.not_found_prices')]);
        }
              break;
            
            default:
        
          return  response()->json(['success' => false, 'is_empty' => true, 'data'=> null, 'message' => __('ERP::messages.orders.not_found_prices')]);
       
              break;
          }


        if($is_classfy){

        $dataArray = (object) [
          'price_id' => $item->id,
          'adult_price' => $item->price_adult,
          'child_price' => $item->price_child,
          'infant_price' => $item->price_infant,

          'adult_cost' => $item->cost_adult,
          'child_cost' => $item->cost_child,
          'infant_cost' => $item->cost_infant,

          'weight_price' => $item->baggage_price,
          'weight_cost' => $item->baggage_cost,
           'currency_id' => $item->currency_id, 
        ];
      }

        $data = collect( $dataArray);
  
          return  response()->json(['success' => true, 'is_empty' => true, 'data'=> $data, 'message' => 'get price', 'is_classfy' => $is_classfy]); 

     }

   public function get_city_lists(Request $request, $city_id){

        if(!$request->ajax()){
          return abort(404);
        }

       $city = City::find($city_id);

        if(!$city) {
            return ['success' => false, 'list' => '', 'message' => __('ERP::messages.somthing_happening_reload')];
        }

        $options = null;

         if($request->list_type == 'hotels'){
          $options = $city->hotels()->pluck('name', 'id')->toArray();
         }elseif ($request->list_type == 'airports') {
           $options = $city->airports()->pluck('name', 'id')->toArray();
         }elseif ($request->list_type == 'activities') {
           $options = $city->activities()->pluck('name', 'id')->toArray();
         }elseif ($request->list_type == 'services') {
           $options = $city->services()->pluck('name', 'id')->toArray();
         }
        


    
      return response()->json(['success' => true, 'message' => 'get hotels', 'list'=>$options]);                                                            
       
    }

       public function get_hotel_lists(Request $request, $hotel_id){

        if(!$request->ajax()){
          return abort(404);
        }

       $hotel = Hotel::find($hotel_id);

        if(!$hotel) {
            return ['success' => false, 'list' => '', 'message' => __('ERP::messages.somthing_happening_reload')];
        }

        $options = null;

         if($request->list_type == 'rooms'){
          $options = $hotel->rooms()->pluck('name', 'id')->toArray();
         }
        


    
      return response()->json(['success' => true, 'message' => 'get hotels', 'list'=>$options]);                                                            
       
    }

  

   public function get_country_lists(Request $request,$country_id){

        if(!$request->ajax()){
          return abort(404);
        }

       $country = Country::find($country_id);

        if(!$country) {
            return ['success' => false, 'list' => '', 'message' => __('ERP::messages.somthing_happening_reload')];
        }

        $options = null;

         if($request->list_type == 'cities'){
          $options = $country->cities()->where('status', 1)->pluck('name', 'id')->toArray();
         }elseif ($request->list_type == 'drivers') {
          $options = $country->drivers()->where('status', 1)->where('user_type','driver')->pluck('name', 'id')->toArray();
         }

          return response()->json(['success' => true, 'message' => 'get list', 'list'=> $options]);

}


 public function getTypesPlaces(Request $request,$city_id, $category){

        if(!$request->ajax()){
          return abort(404);
        }

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

        
         return response()->json(['success' => true, 'message' => 'get places', 'list'=>$options]);                                                            
       
    }

   public function getCategoryPlaces(Request $request,$city_id, $category_id){

        if(!$request->ajax()){
          return abort(404);
        }

         $options = Place::where('category_id', $category_id)->where('city_id', $city_id)->where('status', 1)->pluck('name', 'id')->toArray();

        
        $select = [
            'label' => $request->label,
            'name' => $request->name,
            'required' => $request->required,
            'selected' => $request->selected,
            'options' => $options,
            'attributes' => ['class' => $request->class, 'data-label' => $request->label],
            'select2' => 'select2',
        ];


        $view = view('ERP::partials.cat_places_options')->with(compact('select'))->render();



      return response()->json(['success' => true, 'message' => 'get places', 'data'=> $view]);                                                            
       
    }

     public function getHotelAutoPrices(Request $request){

        if(!$request->hotel_id || !$request->room_id || !$request->checkin){

         return  response()->json(['success' => false, 'is_empty' => false, 'data'=> null, 'message' => __('ERP::messages.orders.required_hotel_auto_prices')]);

        }


        $item = HotelPrice::where('hotel_id', $request->hotel_id)->where('room_id', $request->room_id)->whereHas('hotel_price_dates', function($q) use ($request){
            $q->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->whereDate('from_date', '<', $request->checkin)->whereDate('to_date', '>', $request->checkin);

        })->first();



        if(!$item){
          return  response()->json(['success' => false, 'is_empty' => true, 'data'=> null, 'message' => __('ERP::messages.orders.not_found_prices')]);
        }

        $date = $request->checkin;
        $d    = new \DateTime($date);
        $checkinDay = strtolower($d->format('l'));



        $days = [];
        if($item->price_days){

          $days = json_decode($item->price_days, true);


        if(!in_array($checkinDay, $days)){

        return  response()->json(['success' => false, 'is_empty' => true, 'data'=> null, 'message' => __('ERP::messages.orders.not_found_prices')]);

        }

        }

        return  response()->json(['success' => true, 'is_empty' => true, 'data'=> $item, 'message' => 'get price']);

      

     }

     public function getCountryLists(Request $request, $country_id){

        if(!$request->ajax()){
          return abort(404);
        }

       $country = Country::find($country_id);

        if(!$country) {
            return ['success' => false, 'data' => '', 'message' => __('ERP::messages.somthing_happening_reload')];
        }

        $options = null;

         if($request->other_type == 'cities'){
          $options = $country->cities()->where('status', 1)->pluck('name', 'id')->toArray();
         }elseif ($request->other_type == 'drivers') {
          $options = $country->drivers()->where('status', 1)->where('user_type','driver')->pluck('name', 'id')->toArray();
         }
        
        $select = [
            'label' => $request->label,
            'name' => $request->name,
            'required' => $request->required,
            'selected' => $request->selected,
            'options' => $options,
            'attributes' => ['class' => 'remote_div '.$request->class, 'data-label' => $request->label],
            'select2' => 'select2',
        ];

      

        $view = view('ERP::partials.country_lists_options')->with(compact('select'))->render();



      return response()->json(['success' => true, 'message' => 'get cities', 'data'=> $view]);                                                            
       
    }

    

    public function getRoomsList(Request $request, $hotel_id){

        if(!$request->ajax()){
          return abort(404);
        }

       $hotel = Hotel::find($hotel_id);

        if(!$hotel) {
            return ['success' => false, 'data' => '', 'message' => __('ERP::messages.somthing_happening_reload')];
        }

        $options = null;

         
          $options = $hotel->rooms()->pluck('name', 'id')->toArray();
      
        
        $select = [
            'label' => $request->label,
            'name' => $request->name,
            'required' => $request->required,
            'selected' => $request->selected,
            'options' => $options,
            'attributes' => ['class' => $request->class, 'data-label' => $request->label],
            'select2' => 'select2',
        ];

      

        $view = view('ERP::partials.options_lists')->with(compact('select'))->render();



      return response()->json(['success' => true, 'message' => 'get rooms', 'data'=> $view]);                                                            
       
    }


       public function getCityLists(Request $request, $city_id){

        if(!$request->ajax()){
          return abort(404);
        }

       $city = City::find($city_id);

        if(!$city) {
            return ['success' => false, 'data' => '', 'message' => __('ERP::messages.somthing_happening_reload')];
        }

        $options = null;

         if($request->other_type == 'hotels'){
          $options = $city->hotels()->pluck('name', 'id')->toArray();
         }
        
        $select = [
            'label' => $request->label,
            'name' => $request->name,
            'required' => $request->required,
            'selected' => $request->selected,
            'options' => $options,
            'attributes' => ['class' => $request->class, 'data-label' => $request->label],
            'select2' => 'select2',
        ];

      

        $view = view('ERP::partials.cities_lists_options')->with(compact('select'))->render();



      return response()->json(['success' => true, 'message' => 'get hotels', 'data'=> $view]);                                                            
       
    }

  //function to get the city from the country
    public function getCityAjax(Request $request){


        $country     = $request->get('country_id');
        $cities      = $request->get('cities');
        $places      = $request->get('places');
        $hotels      = $request->get('hotels');
        $rooms       = $request->get('rooms');
        $index       = $request->get('index');
        $drivers     = $request->get('drivers');
        $tax         = $request->get('tax');
        $replacedDiv = $request->get('replacedDiv');
        // $requireds = $request->get('requireds', []);

        // json_decode = 

        //dd($country,$cities,$places,$hotels,$rooms);

        if(!$country) {
            return false;
        }

        if ( $cities== 'true') {
         $cities = City::where('country_id', $country);
         $cities = $cities->pluck('name', 'id');
        }else{
        	$cities = false;
        }

        if ($places == 'true') {
         $places = Place::where('country_id', $country);
         $places = $places->pluck('name', 'id');
        }else{
        	$places = false;
        }

        if ($hotels== 'true') {
         $hotels = Hotel::where('country_id', $country);
         $hotels = $hotels->pluck('name', 'id');
        }else{
        	$hotels = false;
        }

        if ($rooms == 'true') {
         $rooms = Room::all();
         $rooms = $rooms->pluck('name', 'id');
        }else{
            $rooms = false;
        }

        if ($drivers == 'true') {
         $drivers = Driver::all();
         $drivers = $drivers->pluck('name', 'id');
        }else{
            $drivers = false;
        }

        if ($tax == 'true') {
         $country_data = Country::find($country);
         $tax = $country_data->tax;
        }else{
            $tax = false;
        }
                
                                                                           
       //dd($country,$cities,$places,$hotels,$rooms);
        

       
        return view('ERP::ajax.country.cities')->with(compact('cities','places','rooms', 'drivers','hotels','tax','replacedDiv','index'));
       
    }





//function to get the places , hotels and travels from the city
    public function getPlaceAjax(Request $request){


        $city_id = $request->get('city_id');
        $places  = $request->get('places');
        $hotels  = $request->get('hotels');
        $rooms  = $request->get('rooms');
        $index  = $request->get('index');
        $travels  = $request->get('travels');
        $source  = $request->get('source');
        $source_type  = $request->get('source_type');
        $replacedDiv = $request->get('replacedDiv');

        

        if(!$city_id) {
            return false;
        }

        if ($places == 'true') {
         $places = Place::where('city_id', $city_id);
         $places = $places->pluck('name', 'id');
        }else{
            $places = false;
        }

        if ($hotels == 'true') {
         $hotels = Hotel::where('city_id', $city_id);
         $hotels = $hotels->pluck('name', 'id');
        }else{
            $hotels = false;
        }
         if ($rooms == 'true') {
         $rooms = Room::all();
         $rooms = $rooms->pluck('name', 'id');
        }else{
            $rooms = false;
        }

        if ($travels == 'true') {
         $travels = Tour::where('city_id', $city_id);
         $travels = $travels->pluck('name', 'id');
        }else{
            $travels = false;
        }

        if ($source == 'true') {
         
        }else{
            $source = false;
        }

        if ($source_type == 'hotel') {
              $source_hotels = Hotel::where('city_id', $city_id);
              $source_hotels = $source_hotels->pluck('name', 'id');
        }else{
          $source_hotels   = false;

        }

        if($source_type == 'airport'){
            $source_airports = Airport::where('city_id', $city_id);
            $source_airports = $source_airports->pluck('name', 'id');
        }else{
          $source_airports = false;
        }

        if($source_type == 'bus'){
            $source_bus = BusStation::where('city_id', $city_id);
            $source_bus = $source_bus->pluck('name', 'id');
        }else{
          $source_bus      = false;
        } 

        if($source_type == 'ferry'){
            $source_ferries = Ferry::where('city_id', $city_id);
            $source_ferries = $source_ferries->pluck('name', 'id');
        }else{
          $source_ferries  = false;
        } 

        if($source_type == 'tour'){
            $source_travels = Tour::where('city_id', $city_id);
            $source_travels = $source_travels->pluck('name', 'id');
        }else{
          $source_travels  = false;
        } 

        if($source_type == 'journey'){
            $source_journey = Journey::all();
            $source_journey = $source_journey->pluck('name', 'id');
        }else{
          $source_journey  = false;
        }

                                                                                    
             

       
        return view('ERP::ajax.country.places')->with(compact('city_id','places','source_hotels','source_airports','source_ferries','source_bus','source_travels','source_journey','hotels','travels','source','rooms','index','replacedDiv'));
       
    }

//  function to get the hotel rooms 
    public function getHotelAjax(Request $request){


        $hotel = $request->get('hotel_id');
        $rooms  = $request->get('rooms');
        $index  = $request->get('index');
        $replacedDiv = $request->get('replacedDiv');

        if(!$hotel) {
            return false;
        }

        if ($rooms == 'true') {
         $rooms = Room::where('hotel_id', $hotel);
         $rooms = $rooms->pluck('name', 'id');
        }else{
            $rooms = false;
        }
     
        return view('ERP::ajax.country.hotels')->with(compact('rooms','replacedDiv','index'));
       
    }



    //  function to get the branch accounts 
    public function getBranchAjax(Request $request){


        $branch = $request->get('branch_id');
        $accounts  = $request->get('accounts');
        $replacedDiv = $request->get('replacedDiv');

        if(!$branch) {
            return false;
        }

        if ($accounts == 'true') {
         $accounts = Account::where('branch_id', $branch);
         $accounts = $accounts->pluck('name', 'id');
        }else{
            $accounts = false;
        }
     
        return view('ERP::ajax.branches.branch')->with(compact('accounts','replacedDiv'));
       
    }



      //  function to add row on the orders table 
    public function AddRow(Request $request){


        $type = $request->get('type');
        $replacedDiv = $request->get('replacedDiv');
        $index = $request->get('index');


      return view('ERP::ajax.add_rows.add_row')->with(compact('index','replacedDiv'));

         

     
       
    }

     //  function to add row on the packages table 
    public function AddPackageRow(Request $request){


        $type = $request->get('type');
        $replacedDiv = $request->get('replacedDiv');
        $index = $request->get('index');


      return view('ERP::ajax.add_rows.add_package_row')->with(compact('index','replacedDiv'));

         

     
       
    }


    //  function to get the the room price for specific hotel and pass it to the hotels order 
    public function getHotelPrices(Request $request){


        $index  = $request->get('index');
        $room_id = $request->input('hotels.'.$index.'.room_id');
        $entry_date = $request->input('hotels.'.$index.'.entry_date');
        $leave_date = $request->input('hotels.'.$index.'.leave_date');
       // dd($index , $room_id , strtotime($entry_date) , $leave_date);
        $rules = [];

        $rules = array_merge($rules, [
            'hotels.'.$index.'.room_id' => 'required|numeric',
            //'leave_date' => 'required|after_or_equal:'.strtotime($entry_date),            
            'hotels.'.$index.'.entry_date' => 'required|date|before_or_equal:hotels.'.$index.'.leave_date',
            'hotels.'.$index.'.leave_date' => 'required|date|after_or_equal:hotels.'.$index.'.entry_date',            
        ]);

        $validator = Validator::make($request->all(), $rules);

         if ($validator->passes()){

          $hotel_prices = HotelPrice::where('room_id', $room_id )->get();

          //dd($hotel_prices);
          $price_dates = [];
          foreach ($hotel_prices as $hotel_price) {
            $price_dates = $hotel_price->hotelPriceDates()->where([
              ['from_date', '<=', $entry_date] ,
              ['to_date', '>=', $leave_date] ])->first();
           
          }
          if($price_dates)
          {
            $price = $price_dates->hotelPrice->price;
            if($price){
              return response()->json(['success'=>$price]);
            }else{
              return response()->json(['no_price'=> trans('ERP::attributes.validation.no_price')]); 

            }

          }else{
            return response()->json(['no_price'=> trans('ERP::attributes.validation.no_price')]); 
          }
          
        
         }
         else{
         // dd($request->all());
        //  dd($validator->errors()->all());
            return response()->json(['error'=>$validator->errors()->all()]);
         }

    }

        
         //  function to get the the prices for specific flight and pass it to the flights order 
    public function getFlightPrices(Request $request){


        $index           = $request->get('index');
        $type            = $request->input('flights.'.$index.'.type');
        $from_country_id = $request->input('flights.'.$index.'.from_country_id');
        $from_city_id    = $request->input('flights.'.$index.'.from_city_id');
        $to_country_id   = $request->input('flights.'.$index.'.to_country_id');
        $to_city_id      = $request->input('flights.'.$index.'.to_city_id');

        //dd($request->all());

        $rules = [];

        $rules = array_merge($rules, [
            'flights.'.$index.'.type'            => 'required',
            'flights.'.$index.'.from_country_id' => 'required|numeric',
            'flights.'.$index.'.from_city_id'    => 'required|numeric',
            'flights.'.$index.'.to_country_id'   => 'required|numeric',
            'flights.'.$index.'.to_city_id'      => 'required|numeric',            
        ]);

        $validator = Validator::make($request->all(), $rules);

         if ($validator->passes()){

          if($type == "flight"){

              $flight_price = FlightPrice::where([
                ['from_country_id','=', $from_country_id],
                ['from_city_id'   ,'=', $from_city_id],
                ['to_country_id'  ,'=', $to_country_id],
                ['to_city_id'     ,'=', $to_city_id],
                 ])->orderBy('start_date', 'desc')->first();

              //dd($flight_price);
             
              if($flight_price)
              {
                  return response()->json(['success'=>[
                    'price_adult' => $flight_price->price_adult ,
                    'price_child' => $flight_price->price_child, 
                    'price_infant'=> $flight_price->price_infant,
                  ],]);            


              }else{
                return response()->json(['no_price'=> trans('ERP::attributes.validation.no_price')]); 
              }
        
         }else if ($type == "ferry"){

            $ferry_price = FerryPrice::where([
                ['from_country_id','=', $from_country_id],
                ['from_city_id'   ,'=', $from_city_id],
                ['to_country_id'  ,'=', $to_country_id],
                ['to_city_id'     ,'=', $to_city_id],
                 ])->orderBy('start_date', 'desc')->first();

              //dd($ferry_price);
             
              if($ferry_price)
              {
                  return response()->json(['success'=>[
                    'price_adult' => $ferry_price->price_adult ,
                    'price_child' => $ferry_price->price_child, 
                    'price_infant'=> $ferry_price->price_infant,
                  ],]);            


              }else{
                return response()->json(['no_price'=> trans('ERP::attributes.validation.no_price')]); 
              }

         }
       }
         else{
         // dd($request->all());
        // dd($validator->errors()->all());
            return response()->json(['error'=>$validator->errors()->all()]);
         }

    }
       


//  function to get the the prices for specific transport and pass it to the transports order 

    public function getTransportPrices(Request $request){

      //dd($request->all());      
      
        $index           = $request->get('index');
        $country_id      = $request->input('transports.'.$index.'.country_id');
        $from_city_id    = $request->input('transports.'.$index.'.from_city_id');
        $from_source     = $request->input('transports.'.$index.'.from_source');
        $to_city_id      = $request->input('transports.'.$index.'.to_city_id');
        $to_source       = $request->input('transports.'.$index.'.to_source');
        $vehicle_id      = $request->input('transports.'.$index.'.vehicle_id');

        //dd($request->all());

        $rules = [];

        $rules = array_merge($rules, [
            'transports.'.$index.'.from_source'     => 'required',
            'transports.'.$index.'.to_source'       => 'required',
            'transports.'.$index.'.country_id'      => 'required|numeric',
            'transports.'.$index.'.from_city_id'    => 'required|numeric',
            'transports.'.$index.'.to_city_id'      => 'required|numeric', 
            'transports.'.$index.'.vehicle_id'      => 'required|numeric',

        ]);

        $validator = Validator::make($request->all(), $rules);

         if ($validator->passes()){

          $transport_price = TransportPrice::where([
            ['from_country_id','=', $country_id],
            ['from_city_id'   ,'=', $from_city_id],
            ['from_source'  ,'=', $from_source],
            ['to_city_id'     ,'=', $to_city_id],
            ['to_source'     ,'=', $to_source],
             ])->orderBy('updated_at', 'desc')->first();

          //dd($transport_price);
         
          if($transport_price)
          {
            $price = $transport_price->transportTypes->where('vehicle_id',$vehicle_id)->first();
            //dd($price);
            if($price){
              return response()->json(['success'=>[
                'cost' => $price->cost ,
                'price' => $price->price, 
              ],]); 
            }else{
              return response()->json(['no_price'=> trans('ERP::attributes.validation.no_price')]); }            

          }else{
            return response()->json(['no_price'=> trans('ERP::attributes.validation.no_price')]); 
          }
    
         
       }
         else{

            return response()->json(['error'=>$validator->errors()->all()]);
         }

    }    



//filters functions 

 //function to get the the cities form country at filters  

    public function FilterCity(Request $request){
      
        $country_id = $request->get('country_id');
       // dd($country_id);
        $cities = City::where('country_id' ,$country_id);
        $cities = $cities->pluck('name', 'id');        

         if ($cities){
              return response()->json(['success'=>$cities]); 
            }else{
            return response()->json(['error'=> "Not Found cities for this country"]); 
          }         
    }    


//function to get the the hotels form cities at filters  

    public function FilterHotel(Request $request){
      
        $city_id = $request->get('city_id');
       // dd($city_id);
        $hotels = Hotel::where('city_id' ,$city_id);
        $hotels = $hotels->pluck('name', 'id');        

         if ($hotels){
              return response()->json(['success'=>$hotels]); 
            }else{
            return response()->json(['error'=> "there is no hotels for this city"]); 
          }         
    }

    //function to get the the rooms form hotels at filters  

    public function FilterRoom(Request $request){
      
        $hotel_id = $request->get('hotel_id');
        $rooms = Room::where('hotel_id' ,$hotel_id);
        $rooms = $rooms->pluck('name', 'id');        

         if ($rooms){
              return response()->json(['success'=>$rooms]); 
            }else{
            return response()->json(['error'=> "there is no rooms for this city"]); 
          }         
    }



    //function to get the the source name by source type at filters  

    public function FilterSource(Request $request){
       $source = $request->get('source');
        $city_id = $request->get('from_city_id');

      $rules = [];

        $rules = array_merge($rules, [
            'from_city_id'    => 'required|numeric',
        ]);


        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()){

          if($source == "hotel"){
            $source_name = Hotel::where('city_id' ,$city_id);
            $source_name = $source_name->pluck('name', 'id');

          }elseif($source == "airport"){
            $source_name = Airport::where('city_id' ,$city_id);
            $source_name = $source_name->pluck('name', 'id');

          }elseif($source == "ferry"){
            $source_name = Ferry::where('city_id' ,$city_id);
            $source_name = $source_name->pluck('name', 'id');

          }elseif($source == "bus"){
            $source_name = BusStation::where('city_id' ,$city_id);
            $source_name = $source_name->pluck('name', 'id');

          }elseif($source == "journey"){
            $source_name = Journey::all();
            $source_name = $source_name->pluck('name', 'id');
          }else{
            $source_name = null;
          }

          if ($source_name){
              return response()->json(['success'=>$source_name]); 
            }else{
            return response()->json(['error'=> "there is no sources"]); 
          } 
         
        }else{
            // if the validation failed 
            return response()->json(['error'=>$validator->errors()->all()]);
         }

                 
    }

     //function to get the the target name  by  target type at filters  

    public function FilterTarget(Request $request){
       $source = $request->get('source');
        $city_id = $request->get('to_city_id');

      $rules = [];

        $rules = array_merge($rules, [
            'to_city_id'    => 'required|numeric',
        ]);


        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()){

          if($source == "hotel"){
            $source_name = Hotel::where('city_id' ,$city_id);
            $source_name = $source_name->pluck('name', 'id');

          }elseif($source == "airport"){
            $source_name = Airport::where('city_id' ,$city_id);
            $source_name = $source_name->pluck('name', 'id');

          }elseif($source == "ferry"){
            $source_name = Ferry::where('city_id' ,$city_id);
            $source_name = $source_name->pluck('name', 'id');

          }elseif($source == "bus"){
            $source_name = BusStation::where('city_id' ,$city_id);
            $source_name = $source_name->pluck('name', 'id');

          }elseif($source == "journey"){
            $source_name = Journey::all();
            $source_name = $source_name->pluck('name', 'id');

          }elseif($source == "tour"){
            $source_name = Tour::where('city_id' ,$city_id);
            $source_name = $source_name->pluck('name', 'id');

          }else{
            $source_name = null;
          }

          if ($source_name){
              return response()->json(['success'=>$source_name]); 
            }else{
            return response()->json(['error'=> "there is no sources"]); 
          } 
         
        }else{
            // if the validation failed 
            return response()->json(['error'=>$validator->errors()->all()]);
         }

                 
    }









}

    















