<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\CustomersDataTable;
use Packages\Modules\ERP\Http\Requests\CustomerRequest;
use Packages\Modules\ERP\Http\Requests\AjaxCustomerRequest;
use Packages\Modules\ERP\Models\UserErp;

class CustomersController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.customer.resource_url');

        $this->title = 'ERP::module.customer.title';
        $this->title_singular = 'ERP::module.customer.title_singular';

        parent::__construct();
    }

    /**
     * @param CustomerRequest $request
     * @param CustomersDataTable $dataTable
     * @return mixed
     */
    public function index(CustomerRequest $request, CustomersDataTable $dataTable)
    {
        return $dataTable->render('ERP::customers.index');
    }

    /**
     * @param CustomerRequest $request
     * @return $this
     */
    public function create(CustomerRequest $request)
    {
       
        $customer = new UserErp();


        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::customers.create_edit')->with(compact('customer'));
    }

    /**
     * @param CustomerRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CustomerRequest $request)
    {
        try {
   
           
         \ERP::storeUser($request, 'client');

        

        flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, UserErp::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param CustomerRequest $request
     * @param UserErp $customer
     * @return UserErp
     */
    public function show(CustomerRequest $request, UserErp $customer)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $customer->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $UserErp->hashed_id . '/edit']);

        return view('ERP::customers.show')->with(compact('customer'));
    }

    /**
     * @param CustomerRequest $request
     * @param UserErp $customer
     * @return $this
     */
    public function edit(CustomerRequest $request, UserErp $customer)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $customer->name])]);

        return view('ERP::customers.create_edit')->with(compact('customer'));
    }

    /**
     * @param CustomerRequest $request
     * @param UserErp $customer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CustomerRequest $request, UserErp $customer)
    {
        try {


           \ERP::updateUser($request, $customer, 'client');

         
            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, UserErp::class, 'update');
        }

        return redirectTo($this->resource_url);
    }


    /**
     * @param CustomerRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function ajax_store(AjaxCustomerRequest $request)
    {
        try {

       $data = $request->except('user_data.picture_thumb', 'user_data.passport_image', 'user_data.user_password');


$data = $data['user_data'];


      $data = array_merge(['name' => $request->input('user_data.translated_name.ar'), 'name_en' => $request->input('user_data.translated_name.en'), 'nick_name' => $request->input('user_data.translated_nick_name.ar'), 'nick_name_en' => $request->input('user_data.translated_nick_name.en'), 'user_type' => 'client'], $data);


    if(is_null($request->get('user_data.user_password'))){
        $data['password'] = encrypt(uniqid());
        
        }else{

        $data['password'] = $request->get('user_data.user_password');

        }



      $user = UserErp::create($data);


   

    if ($request->hasFile('picture_thumb')) {
        $user->addMedia($request->file('user_data.picture_thumb'))
        ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
        ->toMediaCollection('user-picture');
        
    }

      if ($request->hasFile('passport_image')) {
    $user->addMedia($request->file('user_data.passport_image'))
        ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
        ->toMediaCollection('passport-image');
       }
       
        

        flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, UserErp::class, 'store');
        }

        return  response()->json(['success' => true, 'data'=> ['id' => $user->id, 'name' => $user->translated_name, 'code' => $user->user_code ]]);
    }



    /**
     * @param CustomerRequest $request
     * @param UserErp $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CustomerRequest $request, UserErp $customer)
    {
        try {
            $customer->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, UserErp::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}