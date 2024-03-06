<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\Http\Requests\CustomerRequest;
use Packages\Modules\ERP\Models\Customer;
use Illuminate\Http\Request;
use Packages\User\Models\User;
use Validator;


class CustomersAjaxController extends BaseController
{

   
    /**
     * @param CustomerRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function ajax_store(Request $request)
    {

          $rules = [];

           $rules = array_merge($rules, [
            'name' => 'required|max:191',
            'phone_country_code' => 'required',
            'email' => 'required|email|max:191|unique:users,email',
            'code' => 'required|max:191|unique:users,code',
            'phone_number' => 'required|unique:users,phone_number',
            'password' => 'required|confirmed|max:191|min:6'
            
          ]);

        $validator = Validator::make($request->all(), $rules);

         if ($validator->passes()){

                try {
            $data = $request->except('phone_one','phone_two','passport','password_confirmation');

            $user = User::create($data);

            $customer_info[] =  $request->get('phone_one','phone_two','passport');

            $customer_info = array_merge($customer_info , ['user_id' => $user->id]);

            $customer = Customer::create($customer_info);

            $customer_code = $user->code;
            //dd($customer_code);

            flash(trans('Packages::messages.success.created', ['item' => 'Customer']))->success();        
            }catch (\Exception $exception) {
                log_exception($exception, User::class, 'store');
            }

            return view('ERP::ajax.customers.customer')->with(compact('customer_code'));
             }
             else{
                return response()->json(['error'=>$validator->errors()->all()]);
             }

    }
         
        //dd($request->all());
    

   
}