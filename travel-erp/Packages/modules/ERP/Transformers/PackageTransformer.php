<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Order;

class PackageTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.package.resource_url');

        //$this->customer_route   = config('erp.models.customer_order.resource_url');

        parent::__construct();
    }

    /**
     * @param Order $order
     * @return array
     * @throws \Throwable
     */
    
    public function transform(Order $order)
    {
        $show_url = url($this->resource_url . '/' . $order->hashed_id);

         // $url = url($this->customer_route, ['customer' => $order->customer->hashed_id]);

     // $actions =['Customer Orders'=>['href'=> "$url",'label' => 'Customer Orders','data' => []]];

      $hotel_orders = $order->hotelOrders();
      $flight_orders = $order->flightOrders();
      $transport_orders = $order->transportOrders();
        $hotels_cost = 0;
        $hotel_tax = 0;
        $hotel_prepay_percent = 0;

        $flights_cost = 0;
        $flight_tax = 0;
        $flight_prepay_percent = 0;

        $transports_cost = 0;
        $transport_tax = 0;
        $transport_prepay_percent = 0;

      if($hotel_orders){

        foreach ($hotel_orders->get() as $hotel_order) {
          $final_price=  $hotel_order->final_price;
          $hotels_cost  = $final_price + $hotels_cost;
          $hotel_tax = $hotel_order->tax;
          $hotel_prepay_percent = $hotel_order->prepay_percent;

        }
       // $hotels_cost = 999;
      // $hotel_order = $hotel_orders->first();

       $hotels_tax = $hotels_cost*$hotel_tax/100;
       $hotels_prepay_percent = $hotels_cost*$hotel_prepay_percent/100;

       $final_hotels_cost = $hotels_cost+$hotels_tax;

      }else{
        $hotels_cost =0.00;
        $hotels_tax =0.00;
        $hotels_prepay_percent =0.00;
        $final_hotels_cost =0.00;
      }

      if($flight_orders){

        foreach ($flight_orders->get() as $flight_order) {
          $final_price=  $flight_order->final_price;
          $flights_cost  = $final_price + $flights_cost;
          $flight_tax = $flight_order->tax;
          $flight_prepay_percent = $flight_order->prepay_percent;

        }
       // $flights_cost = 999;
      // $flight_order = $flight_orders->first();

       $flights_tax = $flights_cost*$flight_tax/100;
       $flights_prepay_percent = $flights_cost*$flight_prepay_percent/100;

       $final_flights_cost = $flights_cost+$flights_tax;

      }else{
        $flights_cost =0.00;
        $flights_tax =0.00;
        $flights_prepay_percent =0.00;
        $final_flights_cost =0.00;
      }


      if($transport_orders){

        foreach ($transport_orders->get() as $transport_order) {
          $final_price=  $transport_order->final_price;
          $transports_cost  = $final_price + $transports_cost;
          $transport_tax = $transport_order->tax;
          $transport_prepay_percent = $transport_order->prepay_percent;

        }
       // $transports_cost = 999;
      // $transport_order = $transport_orders->first();

       $transports_tax = $transports_cost*$transport_tax/100;
       $transports_prepay_percent = $transports_cost*$transport_prepay_percent/100;

       $final_transports_cost = $transports_cost+$transports_tax;

      }else{
        $transports_cost =0.00;
        $transports_tax =0.00;
        $transports_prepay_percent =0.00;
        $final_flights_cost =0.00;
      }


      $final_cost = $final_flights_cost + $final_hotels_cost + $final_transports_cost ;
      $final_tax = $flights_tax + $hotels_tax + $transports_tax;
      $final_prepay_percent = $flights_prepay_percent + $hotels_prepay_percent + $transports_prepay_percent;


            

        return [
            'id' => $order->id,
            'order_code' => $order->order_code,
            'hotels_cost' => $hotels_cost,
            'flights_cost' => $flights_cost,
            'transports_cost' => $transports_cost,
            'tax' => $final_tax,
            'final_cost' => $final_cost,
            'prepay_percent' => $final_prepay_percent,
            'prepay_percent' => 0.00,
            'payed_final' => 0.00,
            'rest_final' => $final_cost,
            'agent_id' => $order->agent?$order->agent->name:'',
            'notes' => $order->notes,
            'created_at' => format_date($order->created_at),
            'updated_at' => format_date($order->updated_at),
            'action' => $this->actions($order)
        ];
    }
}