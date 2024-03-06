<?php

namespace Modules\Components\LMS\Classes;

use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\UserLMS;
use Modules\Components\LMS\Models\Favourite as FavouriteModel;
use Modules\User\Models\User;
use Modules\Components\LMS\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class Favourite
{
    /**
     * LMS constructor.
     */
    function __construct()
    {
    }

    public function check($module, $module_id, $user_id = null){

      if(!Auth::check())
        return false;
      if($user_id){

        $user = UserLMS::find($user_id);
      }else{
        $user = UserLMS::find(Auth()->id());
      }
      
      $countFavourite = $user->favourites()->where('favourittable_type', $module)->where('favourittable_id', $module_id)->count();

      if($countFavourite){
        return true;

      }
      return false;

    }

      public function favourite($module, $module_id, $user_id = null){

        if(!Auth::check()){
           return ['success' => false, 'actionType' => 'add'];
        }
        
        
        if($user_id){
        $user = UserLMS::find($user_id);
      }else{
        $user = UserLMS::find(Auth()->id());
      }

        if($this->check($module, $module_id, $user_id)){
          return $this->unfavourite($module, $module_id, $user_id);

        }

         FavouriteModel::create([
          'user_id' => $user->id,
          'favourittable_type' => $module,
          'favourittable_id' => $module_id
         ]);


        return ['success' => true, 'actionType' => 'add'];


    }

    public function unfavourite($module, $module_id, $user_id = null){

       if(!Auth::check()){
           return ['success' => false, 'actionType' => 'add'];
        }

    if($user_id){
        $user = UserLMS::find($user_id);
      }else{
        $user = UserLMS::find(Auth()->id());
      }

       $userFavourites = $user->favourites()->where('favourittable_type', $module)->where('favourittable_id', $module_id)->get();
       if($userFavourites){
       foreach ($userFavourites as $fav) {
        
       $fav->delete();
         
       }
       }

       return ['success' => true, 'actionType' => 'remove'];


    }


     


}