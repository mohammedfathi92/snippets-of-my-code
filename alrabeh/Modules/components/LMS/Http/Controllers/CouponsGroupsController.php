<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\CouponsGroupsDataTable;
use Modules\Components\LMS\Http\Requests\CouponGroupRequest;
use Modules\Components\LMS\Models\Coupon as CouponGroup;

class CouponsGroupsController extends BaseController
{


    public function __construct()
    {


        $this->resource_url = config('lms.models.coupon_group.resource_url');
        $this->title = 'LMS::module.coupon_group.title';
        $this->title_singular = 'LMS::module.coupon_group.title_singular';
        parent::__construct();
    }

    /**
     * @param CouponRequest $request
     * @param CouponsGroupsDataTable $dataTable
     * @return mixed
     */
    public function index(CouponGroupRequest $request, CouponsGroupsDataTable $dataTable)
    {
        return $dataTable->render('LMS::coupons_groups.index');
    }

    /**
     * @param CouponRequest $request
     * @return $this
     */
    public function create(CouponGroupRequest $request)
    {
        $coupon_group = new CouponGroup();

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::coupons_groups.create_edit')->with(compact('coupon_group'));
    }

    /**
     * @param CouponRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CouponGroupRequest $request)
    {
        try {
            $data = $request->except('users', 'courses', 'quizzes', 'plans');

            $coupon_group = CouponGroup::create($data);

            if ($request->get('users')) {

                $coupon_group->users()->sync($request->get('users'));
            }

            if ($request->get('courses')) {
                $coupon_group->courses()->sync($request->get('courses'));
            }

             if ($request->get('quizzes')) {
                $coupon_group->quizzes()->sync($request->get('quizzes'));
            }

             if ($request->get('plans')) {
                $coupon_group->plans()->sync($request->get('plans'));
            }

            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, CouponGroup::class, 'store');
        }

        return redirectTo($this->resource_url.'/'.$coupon_group->hashed_id.'/edit');
    }

    /**
     * @param CouponGroupRequest $request
     * @param CouponGroup $coupon_group
     * @return CouponGroup
     */
    public function show(CouponGroupRequest $request, CouponGroup $coupon_group)
    {
        return $coupon_group;
    }

    /**
     * @param CouponGroupRequest $request
     * @param CouponGroup $coupon_group
     * @return $this
     */
    public function edit(CouponGroupRequest $request, CouponGroup $coupon_group, $hashed_id)
    {
        $id = hashids_decode($hashed_id);
        $coupon_group = CouponGroup::find($id);
        if(!$coupon_group){
            abort(404);
        }

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $coupon_group->name])]);

        return view('LMS::coupons_groups.create_edit')->with(compact('coupon_group'));
    }

    /**
     * @param CouponGroupRequest $request
     * @param CouponGroup $coupon
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CouponGroupRequest $request, CouponGroup $coupon_group, $hashed_id)
    {
        try {
            $data = $request->except('users','courses', 'quizzes', 'plans','generate_coupons');
            $id = hashids_decode($hashed_id);
        $coupon_group = CouponGroup::find($id);
        if(!$coupon_group){
            abort(404);
        }

            if($request->input('generate_coupons.submit')){
               
           
              $this->generate_coupons($request, $coupon_group);
            }

            $coupon_group->update($data);

           
            if ($request->get('users')) {
                $coupon_group->users()->sync($request->get('users'));

            }

            if ($request->get('courses')) {
                $coupon_group->courses()->sync($request->get('courses'));
            }

             if ($request->get('quizzes')) {
                $coupon_group->quizzes()->sync($request->get('quizzes'));
            }

             if ($request->get('plans')) {
                $coupon_group->plans()->sync($request->get('plans'));
            }

           
              $this->generated_coupons_update($request, $coupon_group);
          



            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, CouponGroup::class, 'update');
        }

        return redirectTo($this->resource_url.'/'.$coupon_group->hashed_id.'/edit');
    }
    
    public function generate_coupons($request, $coupon_group)
    {

        $coupons_num = $request->input('generate_coupons.number');

        $data = $request->except('users', 'courses', 'quizzes', 'plans');
        $auth_id = user()->id;


        for ($i=0; $i <= $coupons_num; $i++) { 

            $numRand = rand(1, 9);

            $code = \LMS::codeGenerator(12, false, substr($numRand.$auth_id,0,2));

            $coupon = CouponGroup::create([ 
                "code" => $code,
                "is_group" => 0,
                "type" => $request->get('type'),
                "value" => $request->get('value'),
                "start" => $request->get('start'),
                "expiry" => $request->get('expiry'),
                "uses" => $request->get('uses'),
                "parent_id" => $coupon_group->id,
            ]);

            if ($request->get('users')) {

                $coupon->users()->sync($request->get('users'));
            }

            if ($request->get('courses')) {
                $coupon->courses()->sync($request->get('courses'));
            }

             if ($request->get('quizzes')) {
                $coupon->quizzes()->sync($request->get('quizzes'));
            }

             if ($request->get('plans')) {
                $coupon->plans()->sync($request->get('plans'));
            }
            
        }

        flash(trans('LMS::messages.generated_coupons_success'))->success();


        return redirectTo($this->resource_url.'/'.$coupon_group->hashed_id.'/edit');
    }


        public function generated_coupons_update($request, $coupon_group)
    {


        $data = $request->except('users', 'courses', 'quizzes', 'plans');
        $auth_id = user()->id;

        $generated_coupons = CouponGroup::where('parent_id', $coupon_group->id)->get();

        if($generated_coupons->count()){

        foreach ($generated_coupons as $coupon) {
            $coupon = $coupon->update([ 
                "is_group" => 0,
                "type" => $request->get('type'),
                "value" => $request->get('value'),
                "start" => $request->get('start'),
                "expiry" => $request->get('expiry'),
                "uses" => $request->get('uses'),
            ]);

            if ($request->get('users')) {

                $coupon->users()->sync($request->get('users'));
            }

            if ($request->get('courses')) {
                $coupon->courses()->sync($request->get('courses'));
            }

             if ($request->get('quizzes')) {
                $coupon->quizzes()->sync($request->get('quizzes'));
            }

             if ($request->get('plans')) {
                $coupon->plans()->sync($request->get('plans'));
            }
        }

        }


        return true;
    }

     public function coupons_list($hashed_id)
    {
        $id = hashids_decode($hashed_id);
        $coupon_group = CouponGroup::find($id);
        if(!$coupon_group){
            abort(404);
        }

        $coupons_list = CouponGroup::where('parent_id', $coupon_group->id)->get();

        return view('LMS::coupons_groups.coupons_list')->with(compact('coupon_group','coupons_list'));

    }

        

    /**
     * @param CouponGroupRequest $request
     * @param CouponGroup $coupon_group
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CouponGroupRequest $request, CouponGroup $coupon_group)
    {
        try {
            $coupon_group->clearMediaCollection($coupon_group->mediaCollectionName);
            $coupon_group->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, CouponGroup::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

}
