<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace app\Http\Controllers;

use App\ContactSetting;
use App\Http\Controllers\Controller;
use App\Mail\ContactUsReply;
use App\Mail\ContactUsThankYou;
use App\Mail\NewContactUsMessage;
use App\Message;
use App\Reply;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{


    function index()
    {
        $this->data['title'] = trans("messages.page_title") . " - " . $this->data['title'];
        $this->data['settings'] = ContactSetting::first();
        return view("frontend.contact_us.index", $this->data);
    }

    function sendMessage(Request $request)
    {

        $settings = ContactSetting::first();
        $rules["name"] = "required|max:255";
        $rules["email"] = "required|email|max:255";
        $rules["subject"] = "required|max:255";
        $rules["message"] = "required|min:10";
        if ($settings->show_mobile)
            $rules["mobile"] = "max:15|min:5";
        if ($settings->show_mobile && $settings->mobile_required)
            $rules["mobile"] = "required";
        if ($settings->show_country)
            $rules["country"] = "min:3|max:50";
        if ($settings->show_country && $settings->county_required)
            $rules["country"] = "required";

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $message = new Message();
        $message->subject = $request->input("subject");
        $message->message = $request->input("message");
        $message->name = $request->input("name");
        $message->email = $request->input("email");
        $message->country = $request->input("country");
        $message->mobile = $request->input("mobile");

        if ($message->save()) {
            // send email to user after message saved
            // create a reply message

            $search_str = ['%name%' => $message->name, '%email%' => $message->email, '%subject%' => $message->subject, '%message%' => $message->message];
            $message_content = str_replace(array_keys($search_str), array_values($search_str), $settings->sent_success_message);

            $reply = new Reply();
            $reply->message_id = $message->id;
            $reply->user_id = $settings->auto_reply_user;
            $reply->message_text = $message_content;
            $reply->save();

            Mail::to($message->email)->send(new ContactUsReply($reply));

            // send email notification to receivers in settings
            $emails = explode(PHP_EOL, Setting::get("receivers_emails"));
            if ($emails && is_array($emails)) {
                $emails = array_map('trim', $emails);
                Mail::to($emails)->send(new NewContactUsMessage($message));
            }

            return redirect()->back()->with(["message" => trans("messages.frontend_success_message_sent"), 'alert-type' => "success"]);
        }
        return redirect()->back()->with(["message" => trans("messages.frontend_success_message_sent"), 'alert-type' => "success"]);

    }
}