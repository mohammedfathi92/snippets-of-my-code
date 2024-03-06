<?php

namespace App\Http\Controllers\backend;

use App\Category;

use App\Company_account;
use App\Events\UserLogs;
use App\Financial_transaction;
use App\Product;
use App\ProductPayment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

use TCG\Voyager\Facades\Voyager;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Voyager::can('show_user_products'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        // $this->data['users_products'] = User::find(8);
        $limit = 20;
        $payments = new ProductPayment;
        $this->data['payments'] = $payments;

        return view('store_control.index', $this->data);
    }

    public function show_product($id)
    {
        if(!Voyager::can('show_user_products'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $this->data['product_payment'] = ProductPayment::findOrFail($id);

        $this->data['product_financial'] = $this->data['product_payment']->buyer->financial_transaction
            ->where('product_id', $this->data['product_payment']->product->id)
            ->where('price', $this->data['product_payment']->price)->first();


        return view('store_control.show', $this->data);
    }

    public function buy_product()
    {

        if(!Voyager::can('create_user_products'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $this->data['investors'] = User::where('is_investor', 1)->select('name', 'id')->get();
        $this->data['categories'] = Category::all();
        return view('store_control.buy_product', $this->data);
    }

    public function ajax_get_products(Request $request)
    {
        $this->data['num'] = 0;
        $this->data['products'] = Product::where('category_id', $request['id'])->get();
        return view('store_control.ajax_get_products', $this->data);
    }

    public function buy_product_store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|integer',
            'category' => 'required|integer',
            'account_id' => 'required|integer',
        ]);


        $count_product = Product::where('category_id', $request->input('category'))->count();

        $user = User::findOrFail($request->input('user_id'));


        $user_account = Company_account::where('id', $request->input('account_id'))->first();

        $price = 0;

        for ($i = 1; $i <= $count_product; $i++) {

//            if($request['price_' . $i] <= 0 or $request['quantity_' . $i] <= 0)
//                return redirect()->back()->with(['message'=> __('messages.store.check_amount'),
//                    'alert_danger'=>'info']);

            if ($request['price_' . $i] != null and $request['quantity_' . $i] != null) {

                $price = $price + $request['total_price_' . $i];

                if ($price > $user_account->account_value)
                    return redirect()->back()->with(['message' => __('messages.store.check_money'),
                        'alert_danger' => 'info']);


                $user->products()->attach($request['product_' . $i], ['price' => $request['price_' . $i],
                    'quantity' => $request['quantity_' . $i]]);


                //financial_transaction
                $product = Product::findOrFail($request['product_' . $i]);

                $total = $request['price_' . $i] * $request['quantity_' . $i];

                $financial = Financial_transaction::create([
                    'created_by' => Auth()->id(),
                    'updated_by' => Auth()->id(),
                    'product_id' => $request['product_' . $i],
                    'account_id' => $request->input('account_id'),
                    'user_id' => $request->input('user_id'),
                    'type' => 'pull_buy',
                    'price' => $request['price_' . $i],
                    'notes' => __('messages.store.Financial',['amount'=>$total , 'name'=>$user->name
                    , 'product'=> $product->name ,'number'=> $request['quantity_' . $i]]),
                ]);

            } else {
                continue;
            }
        }

        //update_company_account
        $user_account->account_value -= $price;
        $user_account->save();

        $logs = [
            'action' => 'investor_buy_product',
            'notes' => 'user_investor_buy_product',
            'attrs' => [
                'buy_product' => $financial->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect('admin/store')->with(['message' => __('messages.store.create')]);
    }

    public function destroy($id)
    {

        if(!Voyager::can('delete_user_products'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        ProductPayment::findOrFail($id)->delete();


        $logs = [
            'action' => 'delete_investor_product',
            'notes' => 'user_delete_investor_product',
            'attrs' => [
                'buy_product' => $id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect('admin/store')->with(['message' => __('messages.store.delete')]);
    }

    public function advanced_search(Request $request)
    {
        $investor_products = new ProductPayment;
        if ($request->has('product') and $request->input('product') != null) {
            $investor_products = ProductPayment::whereHas('product', function ($q) {
                $q->where('name', Input::get('product'));
            });
        }

        if ($request->has('investor') and $request->input('investor') != null) {
            $investor_products = ProductPayment::whereHas('buyer', function ($q) {
                $q->where('name', Input::get('investor'));
            });
        }

        return view('store_control.index', ['payments' => $investor_products]);
    }
}



