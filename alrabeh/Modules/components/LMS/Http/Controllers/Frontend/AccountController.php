<?php

namespace Modules\Components\LMS\Http\Controllers\Frontend;

use Modules\Foundation\Http\Controllers\PublicBaseController;
use Modules\User\Facades\TwoFactorAuth;
use Modules\Components\LMS\Models\Question;
use Modules\Components\LMS\Models\Answer;
use Modules\Components\LMS\Models\Certificate;
use Modules\Components\LMS\Models\StudentCertificate;
use Illuminate\Http\Request;
use Modules\Components\LMS\Models\UserLMS;
use Modules\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Modules\Components\CMS\Traits\SEOTools;


class AccountController extends PublicBaseController
{
    use SEOTools;

function profile($user_hashed_id){


       $user_id =  hashids_decode($user_hashed_id);
       $userBase = User::find($user_id);
       $userLMS = UserLMS::find($user_id);
       if(!$userBase)
        return abort(404);

        $active_tab = 'profile';
        $active_tab = \Filters::do_filter('active_profile_tab', $active_tab, $userBase);
        
        $subscriptions = $userLMS->subscriptions()->get();
        $hasSubscriptions = !empty($subscriptions)?true:false;

        $userLogs = $userLMS->logs()->where('parent_id', null)->get();

        $page_title = 'الحساب الشخصي';
  
        return view('account.profile')->with(compact('userBase', 'userLMS', 'subscriptions', 'hasSubscriptions', 'userLogs','active_tab', 'page_title'));

    }

   function ajax_show_certificate($hashed_id){
     $id =  hashids_decode($hashed_id);

    $certificate = StudentCertificate::find($id);


    if(!$certificate){
        $error_text = 'some thing happen';
       $view = view('components.ajax_errors')->with(compact('error_text'))->render();
    return response()->json(['success' => false, 'view'=>$view]);
    }
    if(!Auth::check()){
        $error_text = 'some thing happen';
       $view = view('components.ajax_errors')->with(compact('error_text'))->render();
    return response()->json(['success' => false, 'view'=>$view]);
    }
    $template = $certificate->template;
   $response = \LMS::getCertificateData($certificate, $template);

   $content = $response['content'];




    $view = view('components.certificate')->with(compact('content', 'certificate', 'template'))->render();
    return response()->json(['success' => true, 'view'=>$view]);

    }

    function update(Request $request, $user_hashed_id)
    {
            try {

       $user_id =  hashids_decode($user_hashed_id);
       $user = User::find($user_id);

         $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191|unique:users,email,' . $user->id,
            // 'old_password' => 'required_if:password, !nullable',
            'password' => 'nullable|confirmed|max:191|min:6',
            'picture' => 'mimes:jpg,jpeg,png|max:' . maxUploadFileSize(),
            'phone_country_code' => 'required',
            'phone_number' => 'required|unique:users,phone_number,' . user()->id,
        ]);


    

   
    // if(decrypt($user->password) != $request->old_password){
     
    // return redirect()->back()->with(['message' => __('password not correct'), 'alert-type' => 'error']);//@transM
    //         }

            $data = $request->except('clear', 'profile_image', 'password_confirmation', 'channel', 'two_factor_auth_enabled', 'old_password', 'user_id', 'user_country', 'picture');

            $data['notification_preferences'] = $request->get('notification_preferences', []);

            if (is_null($data['password'])) {
                unset($data['password']);
            }

            if (TwoFactorAuth::isActive()) {

                if (!TwoFactorAuth::isRegistered($user)) {
                    $user->setAuthPhoneInformation($data['phone_country_code'], $data['phone_number']);
                    $twoFactorOptions = TwoFactorAuth::register($user);
                } else {
                    $twoFactorOptions = $user->getTwoFactorAuthProviderOptions();
                }

                $twoFactorOptions['channel'] = $request->get('channel');
                $twoFactorOptions['enabled'] = $request->get('two_factor_auth_enabled') ? true : false;
                $data['two_factor_options'] = json_encode($twoFactorOptions);
            }

            $user->update($data);

             if ($request->has('clear') || $request->hasFile('picture')) {
                $user->clearMediaCollection('user-picture');
            }

            if ($request->hasFile('picture') && !$request->has('clear')) {
                $this->addMedia($request, $user);
            }


            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, 'Profile', 'update');
        }
         return redirect()->back()->with(['message' => __('updated success'), 'alert-type' => 'success']);
   
    
    }


        /**
     * @param Request $request
     * @param User $user
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
     */
    protected function addMedia(Request $request, User $user)
    {
        $user->addMedia($request->file('picture'))
            ->withCustomProperties(['root' => 'user_' . $user->hashed_id])
            ->toMediaCollection('user-picture');
    }

    
}