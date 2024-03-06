<?php

namespace Modules\Components\LMS\Classes;

use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\UserLMS;
use Modules\User\Models\User;
use Modules\Components\LMS\Models\Coupon as CouponLMS;
use Modules\Components\LMS\Models\Plan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class Coupon
{
    /**
     * LMS constructor.
     */
    function __construct()
    {
    }

    public function check($coupon, $attributes = []){

        $user = $attributes['user'];
        $module = $attributes['module'];
        $module_id = $attributes['module_id'];

        $couponData = CouponLMS::where('code', $coupon)->first();

        if($couponData == null){

            return ['success' => false, 'status' => 0, 'coupon' => $couponData,'message' => 'كود الدفع غير صحيح']; //@transM
        }
        
         // check if in available time

        if($couponData->status != 'active'){

             return ['success' => false, 'status' => 1, 'coupon' => $couponData,'message' => 'تأكد من صلاحية كود الحجز']; //@transM
        }

          // check uses


        $countInvoices = $couponData->invoices()->count();


        if($couponData->uses <= $countInvoices){


             return ['success' => false, 'status' => 2, 'coupon' => $couponData,'message' => 'كود الدفع الذي ادخلته منتهي الصلاحية.']; //@transM
        }

        $users = $couponData->users();


        if($users->count()){

            $usersIds = $users->pluck('users.id')->toArray();
             if(!in_array($user->id, $usersIds)){

                 return ['success' => false, 'status' => 3, 'coupon' => $couponData,'message' => 'كود الدفع الذي ادخلته لاتستطيع إستخدامه.']; //@transM

             }

           
        }

        $itemTypes = ['plan', 'course', 'quiz'];

        $couponItems = DB::table('lms_couponables')->where('coupon_id', $couponData->id)->whereIn('lms_couponable_type', $itemTypes)->get();

         
        if($couponItems->count()){

        $moduleCoupon = DB::table('lms_couponables')->where('coupon_id', $couponData->id)->where('lms_couponable_type', $module)->where('lms_couponable_id', $module_id)->get();

        if(!$moduleCoupon->count()){

             return ['success' => false, 'status' => 4, 'coupon' => $couponData,'message' => 'كود الدفع الذي ادخلته لاتستطيع إستخدامه.']; //@transM
               
        }


        }


        return ['success' => true, 'status' => 5, 'coupon' => $couponData,'message' => 'success']; //@transM

    }


     public function get($code = null){
        if($code == null){
             return null;
        }
        $couponData = CouponLMS::where('code', $code)->first();
        return $couponData;

     }



}