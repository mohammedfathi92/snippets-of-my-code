<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\CouponsDataTable;
use Modules\Components\LMS\Http\Requests\CouponRequest;
use Modules\Components\LMS\Models\Coupon;

class CouponsController extends BaseController
{


    public function __construct()
    {


        $this->resource_url = config('lms.models.coupon.resource_url');
        $this->title = 'LMS::module.coupon.title';
        $this->title_singular = 'LMS::module.coupon.title_singular';
        parent::__construct();
    }

    /**
     * @param CouponRequest $request
     * @param CouponsDataTable $dataTable
     * @return mixed
     */
    public function index(CouponRequest $request, CouponsDataTable $dataTable)
    {
        return $dataTable->render('LMS::coupons.index');
    }

    /**
     * @param CouponRequest $request
     * @return $this
     */
    public function create(CouponRequest $request)
    {
        $coupon = new Coupon();

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::coupons.create_edit')->with(compact('coupon'));
    }

    /**
     * @param CouponRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CouponRequest $request)
    {
        try {
            $data = $request->except('users', 'courses', 'quizzes', 'plans');

            $coupon = Coupon::create($data);

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

            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Coupon::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param CouponRequest $request
     * @param Coupon $coupon
     * @return Coupon
     */
    public function show(CouponRequest $request, Coupon $coupon)
    {
        return $coupon;
    }

    /**
     * @param CouponRequest $request
     * @param Coupon $coupon
     * @return $this
     */
    public function edit(CouponRequest $request, Coupon $coupon)
    {
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $coupon->code])]);

        return view('LMS::coupons.create_edit')->with(compact('coupon'));
    }

    /**
     * @param CouponRequest $request
     * @param Coupon $coupon
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        try {
            $data = $request->except('users','courses', 'quizzes', 'plans');

            $coupon->update($data);

            $users = [];
            if ($request->get('users')) {
                $users = $request->get('users');
            }
            $coupon->users()->sync($users);

            if ($request->get('courses')) {
                $coupon->courses()->sync($request->get('courses'));
            }

             if ($request->get('quizzes')) {
                $coupon->quizzes()->sync($request->get('quizzes'));
            }

             if ($request->get('plans')) {
                $coupon->plans()->sync($request->get('plans'));
            }


            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Coupon::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param CouponRequest $request
     * @param Coupon $coupon
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CouponRequest $request, Coupon $coupon)
    {
        try {
            $coupon->clearMediaCollection($coupon->mediaCollectionName);
            $coupon->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Coupon::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

}
