<?php

namespace App\Http\Controllers\backend;

use App\ContactSetting;
use App\Mail\ContactUsReply;
use App\Message;
use App\Reply;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Http\Request;
use LaravelLocalization;
use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class ContactUsController extends BackendBaseController
{
    function index()
    {
        if (!Auth::user()->can("show messages")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $this->data['data'] = Message::orderBy("updated_at", "desc")->get();

        return view("backend.contact_us.index", $this->data);
    }

    function show($id = 0)
    {
        if (!Auth::user()->can("show messages")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $message = Message::with("replies")->find($id);
        if (!$message) {

            return redirect()->back()->with(['message' => trans("messages.id_not_found"), 'alert-type' => 'error']);
        }
        if (!$message->read) {
            $message->read = true;
            $message->save();
        }

        $this->data['data'] = $message;


        return view("backend.contact_us.show", $this->data);
    }

    function reply(Request $request, $id = 0)
    {
        if (!Auth::user()->can("show messages")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $message = Message::find($id);
        if (!$message) {

            return redirect()->back()->with(['message' => trans("messages.id_not_found"), 'alert-type' => 'error']);
        }

        $reply = new Reply();
        $reply->message_id = $id;
        $reply->user_id = Auth::id();
        $reply->message_text = $request->input("message");
        $reply->save();

        // send email to sender
        Mail::to($message->email)->send(new ContactUsReply($reply));
        return redirect()->back()->with(["message" => trans("messages.success_message_sent"), 'alert-type' => 'success']);

    }

    function settings()
    {
        if (!Auth::user()->can("edit messages settings")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $this->data['data'] = ContactSetting::first();
        $this->data['users'] = User::where("level", "<", 2)->get();
        return view("backend.contact_us.settings", $this->data);
    }

    function storeSettings(Request $request)
    {
        if (!Auth::user()->can("edit messages settings")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $rules = [];
        $messages = [];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["info.$locale"] = "max:1500";
            $messages["info.$locale.max"] = trans("messages.validation_info_locale_max", ['locale' => $properties['native'], 'max' => 1500]);

        }
        $rules["auto_reply_user"] = "required";
        $rules["geo_location"] = "max:50|min:8";
        $messages["geo_location.max"] = trans("messages.validation_geo_location_invalid");
        $messages["geo_location.min"] = trans("messages.validation_geo_location_invalid");

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $setting = ContactSetting::first();
        $setting->geo_location = $request->input("geo_location") ?: null;
        $setting->map_background = $request->input("map_background") ?: null;
        $setting->show_mobile = (boolean)$request->input("show_mobile");
        $setting->show_country = (boolean)$request->input("show_country");
        $setting->mobile_required = (boolean)$request->input("mobile_required");
        $setting->auto_reply_user = (int)$request->input("auto_reply_user");
        $setting->country_required = (boolean)$request->input("country_required");
        if ($setting->save()) {
            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $setting->translateOrNew($locale)->info = $request->input('info.' . $locale);
                $setting->translateOrNew($locale)->sent_success_message = $request->input('sent_message.' . $locale);
            }
            $setting->save();
        }

        return redirect()->back()->with(['message' => trans("messages.success_settings_updated"), "alert-type" => "success"]);
    }


    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete messages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $message = Message::find($id);
        if (!$message) {
            return redirect()->back()->with(['message' => trans("contact_us.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $message->photo;
        $gallery = $message->gallery;

        if ($message->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("contact_us.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("contact_us.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete messages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $message = Message::find($id);

                if ($message) {
                    $defaultPhoto = $message->photo;
                    $gallery = $message->gallery;

                    if ($message->delete()) {
                        $uploader = new UploaderController();
                        $uploader->delete($defaultPhoto);
                        // delete photos from storage and database
                        if ($gallery) {
                            foreach ($gallery as $file) {

                                $uploader->delete($file->name);
                            }
                        }
                    }

                    $deleted++;
                }
            }

            return redirect()->back()->with(['message' => trans("contact_us.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("contact_us.error_multi_delete_empty"), 'alert-type' => 'warning']);

    }


}
